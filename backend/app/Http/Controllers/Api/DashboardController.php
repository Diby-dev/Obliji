<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignationTache;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard(): JsonResponse
    {
        $menagers = User::where('role', User::ROLE_MENAGER)->with(['assignationsMenager.tache'])->get();
        $rows = $menagers->map(function (User $menager) {
            $tasks = $menager->assignationsMenager;
            $total = $tasks->count();
            $termines = $tasks->whereIn('statut', [AssignationTache::STATUT_TERMINE, AssignationTache::STATUT_VALIDE])->count();
            return ['user' => ['id' => $menager->id, 'nom' => $menager->nom, 'prenom' => $menager->prenom, 'name' => $menager->nomComplet(), 'email' => $menager->email], 'statistiques' => ['total_assignees' => $total, 'terminees' => $termines, 'en_cours' => $tasks->where('statut', 'en_cours')->count(), 'a_faire' => $tasks->where('statut', 'a_faire')->count(), 'pourcentage_progression' => $total ? round(100 * $termines / $total, 1) : 0]];
        });
        $total = AssignationTache::count();
        $finies = AssignationTache::whereIn('statut', [AssignationTache::STATUT_TERMINE, AssignationTache::STATUT_VALIDE])->count();
        return response()->json(['success' => true, 'data' => ['vue_d_ensemble' => ['nombre_menagers' => $menagers->count(), 'total_taches_assignees' => $total, 'total_taches_terminees' => $finies, 'pourcentage_global' => $total ? round(100 * $finies / $total, 1) : 0], 'menagers' => $rows]]);
    }

    public function menagerDashboard(Request $request): JsonResponse
    {
        $tasks = AssignationTache::where('menager_id', $request->user()->id)->with('tache')->orderBy('date_echeance')->get();
        $total = $tasks->count();
        $finies = $tasks->whereIn('statut', [AssignationTache::STATUT_TERMINE, AssignationTache::STATUT_VALIDE])->count();
        return response()->json(['success' => true, 'data' => ['statistiques' => ['total_assignees' => $total, 'terminees' => $finies, 'en_cours' => $tasks->where('statut', 'en_cours')->count(), 'a_faire' => $tasks->where('statut', 'a_faire')->count(), 'pourcentage_progression' => $total ? round(100 * $finies / $total, 1) : 0], 'assignations' => $tasks]]);
    }
}
