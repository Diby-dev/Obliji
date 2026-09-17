<?php

use App\Http\Controllers\Api\AssignationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\TacheController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Obliji Household Tasks Management
|--------------------------------------------------------------------------
*/

// --- Routes publiques ---
Route::post('/login', [AuthController::class, 'login']);

// --- Routes protégées par authentification Sanctum ---
Route::middleware('obliji.auth')->group(function () {

    // Profil & session
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Tâches ménagères (Consultation ouverte à tous les connectés)
    Route::get('/taches', [TacheController::class, 'index']);
    Route::get('/taches/{id}', [TacheController::class, 'show']);

    // Assignations (Lecture adaptée : tous pour admin, personnelles pour ménager)
    Route::get('/assignations', [AssignationController::class, 'index']);
    // Mise à jour de statut ('a_faire', 'en_cours', 'termine')
    Route::patch('/assignations/{id}/statut', [AssignationController::class, 'updateStatut']);

    // Dashboard Ménager
    Route::get('/dashboard/menager', [DashboardController::class, 'menagerDashboard']);

    // --- Espace réservé exclusivement aux Administrateurs ---
    Route::middleware([CheckRole::class . ':admin'])->group(function () {

        // Gestion du catalogue de tâches
        Route::post('/taches', [TacheController::class, 'store']);
        Route::put('/taches/{id}', [TacheController::class, 'update']);
        Route::delete('/taches/{id}', [TacheController::class, 'destroy']);

        // Création d'assignations
        Route::post('/assignations', [AssignationController::class, 'store']);

        // Dashboard Administrateur avec calculs de progression par ménager
        Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard']);
    });
});
