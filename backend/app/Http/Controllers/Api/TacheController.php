<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Tache::query();
        if ($request->filled('frequence')) $query->where('frequence', $request->string('frequence'));
        return response()->json(['success' => true, 'data' => $query->orderBy('titre')->get()]);
    }
    public function show(int $id): JsonResponse { return response()->json(['success' => true, 'data' => Tache::findOrFail($id)]); }
    public function store(Request $request): JsonResponse
    {
        $tache = Tache::create($request->validate(['titre' => 'required|string|max:150', 'description' => 'nullable|string', 'frequence' => 'nullable|string|max:50']));
        return response()->json(['success' => true, 'message' => 'Tâche créée avec succès.', 'data' => $tache], 201);
    }
    public function update(Request $request, int $id): JsonResponse
    {
        $tache = Tache::findOrFail($id);
        $tache->update($request->validate(['titre' => 'sometimes|required|string|max:150', 'description' => 'nullable|string', 'frequence' => 'nullable|string|max:50']));
        return response()->json(['success' => true, 'message' => 'Tâche mise à jour avec succès.', 'data' => $tache]);
    }
    public function destroy(int $id): JsonResponse { Tache::findOrFail($id)->delete(); return response()->json(['success' => true, 'message' => 'Tâche supprimée avec succès.']); }
}
