<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController; // 👈 NOUVEAU : Import du contrôleur de classe
use Illuminate\Support\Facades\Route;

// Laissez la route de base '/' qui mène à 'welcome' publique.
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 1. ROUTES D'ACCÈS PUBLIC (TOUTES LES FONCTIONS SAUF INDEX) 🌐
|--------------------------------------------------------------------------
| Ces routes sont accessibles SANS connexion.
*/

// Formulaire de création (create) - PUBLIC
Route::get('/eleve/inscription', [EleveController::class, 'create'])->name('eleve.create'); 

// Enregistrement des données (store) - PUBLIC
Route::post('/eleve/inscription', [EleveController::class, 'store'])->name('eleve.store'); 

// DÉTAILS D'UN ÉLÈVE (show) - PUBLIC
Route::get('/eleves/{eleve}', [EleveController::class, 'show'])->name('eleve.show'); 

// TÉLÉCHARGEMENT DU RAPPORT - PUBLIC
Route::get('/eleves/{eleve}/report', [EleveController::class, 'downloadRapportDetaillePdf'])
    ->name('eleve.download.report');

// TÉLÉCHARGEMENT DE LA CARTE D'ACCÈS - DEVIENT PUBLIC
Route::get('/eleves/{eleve}/card', [EleveController::class, 'downloadCarteAccesPdf'])
    ->name('eleve.download.card');
    
// Routes de GESTION des élèves (edit, update, destroy) - PUBLIQUES
Route::resource('gestion-eleves', EleveController::class)
    ->parameters(['gestion-eleves' => 'eleve']) 
    ->only(['edit', 'update', 'destroy'])
    ->names([
        'edit' => 'eleve.edit',
        'update' => 'eleve.update',
        'destroy' => 'eleve.destroy',
    ]);


// Charge les routes d'authentification standard (Login, Logout, etc.)
require __DIR__.'/auth.php'; 

/*
|--------------------------------------------------------------------------
| 2. AUTHENTIFICATION & GESTION PROTÉGÉE (DASHBOARD, PROFILE, LISTE) 🔒
|--------------------------------------------------------------------------
| Ces routes nécessitent une CONNEXION (middleware 'auth').
*/

Route::middleware('auth')->group(function () {
    
    // La route du tableau de bord (protégée)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes du profil utilisateur (protégées)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Liste des élèves (index) - RESTE PROTÉGÉE
    Route::get('/eleves', [EleveController::class, 'index'])->name('eleve.index');
    
    // NOUVEAU : GESTION DES CLASSES (Création, Modification, Suppression)
    // Nous utilisons 'classe.create' et 'classe.store' comme noms de route
    Route::resource('classes', ClasseController::class)
        ->parameters(['classes' => 'classe'])
        ->names([
            'index' => 'classe.index',
            'create' => 'classe.create', // Route d'ajout de classe
            'store' => 'classe.store',
            'edit' => 'classe.edit',     // Route de modification de classe
            'update' => 'classe.update',
            'destroy' => 'classe.destroy',
        ]);
});