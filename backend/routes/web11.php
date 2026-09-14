<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EleveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 1. ROUTES D'INSCRIPTION ÉLÈVE & LECTURE (ACCÈS PUBLIC) 🌐
|--------------------------------------------------------------------------
*/

// Formulaire de création (create)
Route::get('/eleve/inscription', [EleveController::class, 'create'])->name('eleve.create'); 

// Enregistrement des données (store)
Route::post('/eleve/inscription', [EleveController::class, 'store'])->name('eleve.store'); 

// Liste des élèves (index)
Route::get('/eleves', [EleveController::class, 'index'])->name('eleve.index');

// DÉPLACÉ EN PUBLIC : Détails d'un élève (show)
Route::get('/eleves/{eleve}', [EleveController::class, 'show'])->name('eleve.show');


// --- ROUTES SPÉCIFIQUES POUR LE TÉLÉCHARGEMENT DE PDF ---

// 1. Route pour la Carte d'Accès
Route::get('/eleves/{eleve}/card', [EleveController::class, 'downloadCarteAccesPdf'])
    ->name('eleve.download.card');

// 2. Route pour le Rapport Détaillé
Route::get('/eleves/{eleve}/report', [EleveController::class, 'downloadRapportDetaillePdf'])
    ->name('eleve.download.report');


/*
|--------------------------------------------------------------------------
| 2. AUTHENTIFICATION & GESTION ADMIN (PROTÉGÉES) 🔒
|--------------------------------------------------------------------------
*/
// Charge les routes d'authentification standard (Login, Register, etc.)
require __DIR__.'/auth.php'; 

// La route du tableau de bord (protégée)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Routes du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    /*
    | ROUTES DE GESTION DES ÉLÈVES (CRUD protégé)
    |---------------------------------------------
    | Seules l'édition et la suppression sont protégées.
    */
    Route::resource('gestion-eleves', EleveController::class)
        // Mappe le paramètre de l'URL 'gestion-eleves' à la variable 'eleve' pour le Modèle.
        ->parameters(['gestion-eleves' => 'eleve']) 
        ->only(['edit', 'update', 'destroy']) 
        ->names([
            'edit' => 'eleve.edit',
            'update' => 'eleve.update',
            'destroy' => 'eleve.destroy',
        ]);
});
