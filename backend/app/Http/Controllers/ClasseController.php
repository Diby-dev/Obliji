<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ClasseController extends Controller
{
    /**
     * Affiche la liste des classes.
     * (Peut servir de page de gestion pour modifier/supprimer)
     */
    public function index()
    {
        // Récupère toutes les classes triées par type et nom
        $classes = Classe::orderBy('type_classe')->orderBy('nom_classe')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle classe.
     * UTILISE LA VUE UNIFIÉE 'classes.classe'
     */
    public function create()
    {
        // Définit une classe vide pour le formulaire (utile pour réutiliser la vue)
        $classe = new Classe(); 
        // Liste des types de classes suggérés (à adapter si besoin)
        $suggestedTypes = ['Maternelle', 'Primaire', 'Collège', 'Lycée', 'Supérieur', 'Autre']; // Ajout de "Autre" par défaut
        
        // Changement ici : utilise la vue 'classes.classe'
        return view('classes.classe', compact('classe', 'suggestedTypes')); 
    }

    /**
     * Stocke une nouvelle classe dans la base de données.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $validatedData = $request->validate([
            'nom_classe' => 'required|string|max:100|unique:classes', // Le nom doit être unique
            'type_classe' => 'required|string|max:100', // Exemple: "Collège", "Lycée", etc.
            'description' => 'nullable|string|max:500', 
        ]);

        try {
            // 2. Création de la classe
            $classe = Classe::create($validatedData);

            // Redirection vers la liste des classes avec un message de succès
            return redirect()->route('classe.index')->with('success', 'La classe "' . $classe->nom_classe . '" a été ajoutée avec succès.');

        } catch (\Exception $e) {
            Log::error("Erreur lors de la création de la classe: " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de l\'enregistrement de la classe. ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire d'édition d'une classe existante.
     * UTILISE LA VUE UNIFIÉE 'classes.classe'
     */
    public function edit(Classe $classe)
    {
        // Liste des types de classes suggérés (à adapter si besoin)
        $suggestedTypes = ['Maternelle', 'Primaire', 'Collège', 'Lycée', 'Supérieur', 'Autre'];
        
        // Changement ici : utilise la vue 'classes.classe'
        return view('classes.classe', compact('classe', 'suggestedTypes'));
    }

    /**
     * Met à jour la classe spécifiée.
     */
    public function update(Request $request, Classe $classe)
    {
        // 1. Validation des données (Ignorer l'unicité du nom de la classe actuelle)
        $validatedData = $request->validate([
            'nom_classe' => ['required', 'string', 'max:100', Rule::unique('classes')->ignore($classe->id)],
            'type_classe' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);
        
        try {
            // 2. Mise à jour de la classe
            $classe->update($validatedData);

            // Redirection vers la liste des classes avec un message de succès
            return redirect()->route('classe.index')->with('success', 'La classe "' . $classe->nom_classe . '" a été mise à jour avec succès.');

        } catch (\Exception $e) {
            Log::error("Erreur lors de la mise à jour de la classe: " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la mise à jour de la classe.');
        }
    }
    
    /**
     * Supprime la classe spécifiée.
     */
    public function destroy(Classe $classe)
    {
        // Vérification si des élèves sont affectés à cette classe (optionnel, mais recommandé)
        // NOTE: Il faut que la méthode eleves() soit définie dans le modèle Classe (relation hasMany)
        if (method_exists($classe, 'eleves') && $classe->eleves()->count() > 0) {
            return redirect()->route('classe.index')->with('error', 'Impossible de supprimer la classe "' . $classe->nom_classe . '" car elle contient des élèves.');
        }

        try {
            $classe->delete();
            return redirect()->route('classe.index')->with('success', 'La classe a été supprimée avec succès.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression de la classe: " . $e->getMessage());
            return redirect()->route('classe.index')->with('error', 'Une erreur est survenue lors de la suppression de la classe.');
        }
    }

    // Le reste des méthodes (show) peut être omis si non nécessaire pour l'administration.
}