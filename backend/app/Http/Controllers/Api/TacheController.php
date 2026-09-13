<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Liste des modèles de tâches ménagères disponibles.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Tache::query();

        if ($request->has('piece')) {
            $query->where('piece', $request->query('piece'));
        }

        if ($request->has('frequence')) {
            $query->where('frequence', $request->query('frequence'));
        }

        $taches = $query->orderBy('titre')->get();

        return response()->json([
            'success' => true,
            'data'    => $taches->map(function (Tache $tache) {
                return [
                    'id'            => $tache->id,
                    'titre'         => $tache->titre,
                    'description'   => $tache->description,
                    'piece'         => $tache->piece,
                    'frequence'     => $tache->frequence,
                    'duree_estimee' => $tache->duree_estimee,
                    'difficulte'    => $tache->difficulte,
                    'imageUrl'      => '', // Emplacement réservé pour visuel futur
                ];
            }),
        ]);
    }

    /**
     * Création d'une nouvelle tâche (Réservé Admin).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'titre'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'piece'         => 'required|string|max:100',
            'frequence'     => 'nullable|string|max:50',
            'duree_estimee' => 'nullable|integer|min:1',
            'difficulte'    => 'nullable|string|in:facile,moyen,difficile',
        ]);

        $tache = Tache::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tâche créée avec succès.',
            'data'    => array_merge($tache->toArray(), ['imageUrl' => '']),
        ], 201);
    }

    /**
     * Détails d'une tâche.
     */
    public function show(int $id): JsonResponse
    {
        $tache = Tache::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => array_merge($tache->toArray(), ['imageUrl' => '']),
        ]);
    }

    /**
     * Mise à jour d'une tâche (Réservé Admin).
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $tache = Tache::findOrFail($id);

        $validated = $request->validate([
            'titre'         => 'sometimes|required|string|max:255',
            'description'   => 'nullable|string',
            'piece'         => 'sometimes|required|string|max:100',
            'frequence'     => 'nullable|string|max:50',
            'duree_estimee' => 'nullable|integer|min:1',
            'difficulte'    => 'nullable|string|in:facile,moyen,difficile',
        ]);

        $tache->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tâche mise à jour avec succès.',
            'data'    => array_merge($tache->toArray(), ['imageUrl' => '']),
        ]);
    }

    /**
     * Suppression d'une tâche (Réservé Admin).
     */
    public function destroy(int $id): JsonResponse
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tâche supprimée avec succès.',
        ]);
    }
}
