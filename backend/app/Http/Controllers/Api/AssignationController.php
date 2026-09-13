<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignationTache;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignationController extends Controller
{
    /**
     * Liste des assignations.
     * Les admins voient toutes les assignations (ou filtrées par ménager).
     * Les ménagers voient exclusivement leurs propres tâches assignées.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $query = AssignationTache::with(['tache', 'user']);

        if ($user->isMenager()) {
            $query->where('user_id', $user->id);
        } elseif ($request->has('user_id')) {
            $query->where('user_id', $request->query('user_id'));
        }

        if ($request->has('statut')) {
            $query->where('statut', $request->query('statut'));
        }

        if ($request->has('date_echeance')) {
            $query->whereDate('date_echeance', $request->query('date_echeance'));
        }

        $assignations = $query->orderBy('date_echeance', 'asc')->get();

        return response()->json([
            'success' => true,
            'data'    => $assignations->map(function (AssignationTache $assignation) {
                return $this->formatAssignation($assignation);
            }),
        ]);
    }

    /**
     * Création d'une nouvelle assignation (Réservé Admin).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'tache_id'      => 'required|exists:taches,id',
            'date_echeance' => 'required|date',
            'commentaires'  => 'nullable|string',
        ]);

        $assignation = AssignationTache::create([
            'user_id'       => $validated['user_id'],
            'tache_id'      => $validated['tache_id'],
            'date_echeance' => $validated['date_echeance'],
            'statut'        => AssignationTache::STATUT_A_FAIRE,
            'commentaires'  => $validated['commentaires'] ?? null,
        ]);

        $assignation->load(['tache', 'user']);

        // Notification automatique pour le ménager
        Notification::create([
            'user_id' => $assignation->user_id,
            'titre'   => 'Nouvelle tâche assignée',
            'message' => "La tâche '{$assignation->tache->titre}' vous a été assignée pour le {$assignation->date_echeance->format('d/m/Y')}.",
            'lu'      => false,
            'type'    => 'assignation',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tâche assignée avec succès.',
            'data'    => $this->formatAssignation($assignation),
        ], 201);
    }

    /**
     * Mise à jour du statut d'une tâche assignée ('a_faire', 'en_cours', 'termine').
     * Accessible par le ménager titulaire de la tâche ou par un administrateur.
     */
    public function updateStatut(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        $assignation = AssignationTache::with(['tache', 'user'])->findOrFail($id);

        // Vérification des droits : seul l'admin ou le ménager assigné peut modifier
        if ($user->isMenager() && $assignation->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée sur cette assignation.',
            ], 403);
        }

        $validated = $request->validate([
            'statut' => 'required|string|in:a_faire,en_cours,termine',
        ]);

        $nouveauStatut = $validated['statut'];
        $assignation->statut = $nouveauStatut;

        if ($nouveauStatut === AssignationTache::STATUT_TERMINE) {
            $assignation->date_completion = now();
        } else {
            $assignation->date_completion = null;
        }

        $assignation->save();

        return response()->json([
            'success' => true,
            'message' => "Statut de la tâche mis à jour : {$nouveauStatut}",
            'data'    => $this->formatAssignation($assignation),
        ]);
    }

    /**
     * Formatage standardisé de l'assignation avec URL d'image vide.
     */
    private function formatAssignation(AssignationTache $assignation): array
    {
        return [
            'id'              => $assignation->id,
            'user_id'         => $assignation->user_id,
            'tache_id'        => $assignation->tache_id,
            'statut'          => $assignation->statut,
            'date_echeance'   => $assignation->date_echeance ? $assignation->date_echeance->format('Y-m-d') : null,
            'date_completion' => $assignation->date_completion ? $assignation->date_completion->toIso8601String() : null,
            'commentaires'    => $assignation->commentaires,
            'user' => $assignation->user ? [
                'id'       => $assignation->user->id,
                'name'     => $assignation->user->name,
                'email'    => $assignation->user->email,
                'role'     => $assignation->user->role,
                'imageUrl' => '',
            ] : null,
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
    }
}
