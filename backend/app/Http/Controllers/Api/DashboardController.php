<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignationTache;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard pour l'Administrateur :
     * Statistiques globales et suivi de progression par ménager.
     */
    public function adminDashboard(): JsonResponse
    {
        // Récupération de tous les ménagers avec leurs assignations
        $menagers = User::where('role', User::ROLE_MENAGER)
            ->with(['assignations.tache'])
            ->get();

        $menagersData = $menagers->map(function (User $menager) {
            $total = $menager->assignations->count();
            $terminees = $menager->assignations->where('statut', AssignationTache::STATUT_TERMINE)->count();
            $enCours = $menager->assignations->where('statut', AssignationTache::STATUT_EN_COURS)->count();
            $aFaire = $menager->assignations->where('statut', AssignationTache::STATUT_A_FAIRE)->count();

            $pourcentage = $total > 0 ? round(($terminees / $total) * 100, 1) : 0.0;

            return [
                'user' => [
                    'id'        => $menager->id,
                    'name'      => $menager->name,
                    'email'     => $menager->email,
                    'telephone' => $menager->telephone,
                    'imageUrl'  => '', // Laissé vide selon les spécifications
                ],
                'statistiques' => [
                    'total_assignees'         => $total,
                    'terminees'               => $terminees,
                    'en_cours'                => $enCours,
                    'a_faire'                 => $aFaire,
                    'pourcentage_progression' => $pourcentage, // ex: 75.0
                ],
                'taches_recentes' => $menager->assignations->take(5)->map(function ($assignation) {
                    return [
                        'id'            => $assignation->id,
                        'titre'         => $assignation->tache->titre ?? 'Tâche inconnue',
                        'piece'         => $assignation->tache->piece ?? '',
                        'statut'        => $assignation->statut,
                        'date_echeance' => $assignation->date_echeance ? $assignation->date_echeance->format('Y-m-d') : null,
                    ];
                }),
            ];
        });

        $totalAssignations = AssignationTache::count();
        $totalTerminees = AssignationTache::where('statut', AssignationTache::STATUT_TERMINE)->count();
        $tauxGlobal = $totalAssignations > 0 ? round(($totalTerminees / $totalAssignations) * 100, 1) : 0.0;

        return response()->json([
            'success' => true,
            'data'    => [
                'vue_d_ensemble' => [
                    'nombre_menagers'         => $menagers->count(),
                    'total_taches_assignees'  => $totalAssignations,
                    'total_taches_terminees'  => $totalTerminees,
                    'pourcentage_global'      => $tauxGlobal,
                ],
                'menagers' => $menagersData,
            ],
        ]);
    }

    /**
     * Dashboard pour un Ménager connecté :
     * Ses propres tâches et son taux d'accomplissement personnel.
     */
    public function menagerDashboard(Request $request): JsonResponse
    {
        $user = $request->user();

        $assignations = AssignationTache::where('user_id', $user->id)
            ->with('tache')
            ->orderByRaw("CASE WHEN statut = 'a_faire' THEN 1 WHEN statut = 'en_cours' THEN 2 ELSE 3 END")
            ->orderBy('date_echeance', 'asc')
            ->get();

        $total = $assignations->count();
        $terminees = $assignations->where('statut', AssignationTache::STATUT_TERMINE)->count();
        $enCours = $assignations->where('statut', AssignationTache::STATUT_EN_COURS)->count();
        $aFaire = $assignations->where('statut', AssignationTache::STATUT_A_FAIRE)->count();

        $pourcentage = $total > 0 ? round(($terminees / $total) * 100, 1) : 0.0;

        return response()->json([
            'success' => true,
            'data'    => [
                'statistiques' => [
                    'total_assignees'         => $total,
                    'terminees'               => $terminees,
                    'en_cours'                => $enCours,
                    'a_faire'                 => $aFaire,
                    'pourcentage_progression' => $pourcentage,
                ],
                'assignations' => $assignations->map(function ($assignation) {
                    return [
                        'id'              => $assignation->id,
                        'tache_id'        => $assignation->tache_id,
                        'statut'          => $assignation->statut,
                        'date_echeance'   => $assignation->date_echeance ? $assignation->date_echeance->format('Y-m-d') : null,
                        'date_completion' => $assignation->date_completion ? $assignation->date_completion->toIso8601String() : null,
                        'commentaires'    => $assignation->commentaires,
                        'tache' => $assignation->tache ? [
                            'id'            => $assignation->tache->id,
                            'titre'         => $assignation->tache->titre,
                            'description'   => $assignation->tache->description,
                            'piece'         => $assignation->tache->piece,
                            'frequence'     => $assignation->tache->frequence,
                            'duree_estimee' => $assignation->tache->duree_estimee,
                            'difficulte'    => $assignation->tache->difficulte,
                            'imageUrl'      => '',
                        ] : null,
                    ];
                }),
            ],
        ]);
    }
}
