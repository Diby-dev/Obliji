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
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $query = AssignationTache::with(['tache', 'menager', 'admin']);
        if ($user->isMenager()) $query->where('menager_id', $user->id);
        elseif ($request->filled('menager_id')) $query->where('menager_id', $request->integer('menager_id'));
        if ($request->filled('statut')) $query->where('statut', $request->string('statut'));
        return response()->json(['success' => true, 'data' => $query->orderBy('date_echeance')->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(['tache_id' => 'required|exists:taches,id', 'menager_id' => 'required|exists:users,id', 'date_echeance' => 'nullable|date', 'commentaire_realisation' => 'nullable|string']);
        $menager = User::findOrFail($data['menager_id']);
        if (!$menager->isMenager()) return response()->json(['success' => false, 'message' => 'Le destinataire doit avoir le rôle ménager.'], 422);
        $assignation = AssignationTache::create($data + ['admin_id' => $request->user()->id, 'statut' => AssignationTache::STATUT_A_FAIRE]);
        $assignation->load('tache');
        Notification::create(['user_id' => $menager->id, 'titre' => 'Nouvelle tâche assignée', 'message' => "La tâche « {$assignation->tache->titre} » vous a été assignée."]);
        return response()->json(['success' => true, 'message' => 'Tâche assignée avec succès.', 'data' => $assignation->load(['menager', 'admin'])], 201);
    }

    public function updateStatut(Request $request, int $id): JsonResponse
    {
        $assignation = AssignationTache::with(['tache', 'menager', 'admin'])->findOrFail($id);
        $user = $request->user();
        if ($user->isMenager() && $assignation->menager_id !== $user->id) return response()->json(['success' => false, 'message' => 'Action non autorisée sur cette assignation.'], 403);
        $data = $request->validate(['statut' => 'required|in:a_faire,en_cours,termine,valide', 'commentaire_realisation' => 'nullable|string']);
        // A ménager may submit work; validation is reserved for an administrator.
        if ($user->isMenager() && $data['statut'] === AssignationTache::STATUT_VALIDE) return response()->json(['success' => false, 'message' => 'Seul un administrateur peut valider une tâche.'], 403);
        $assignation->update($data);
        return response()->json(['success' => true, 'message' => 'Statut de la tâche mis à jour.', 'data' => $assignation->fresh(['tache', 'menager', 'admin'])]);
    }
}
