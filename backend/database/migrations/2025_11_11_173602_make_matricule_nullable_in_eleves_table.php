<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            // S'assurer que le champ existe et qu'il est déjà unique.
            // La méthode change() permet de modifier la définition d'une colonne existante.
            $table->string('matricule', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            // Pour l'annuler, on revient à NOT NULL
            $table->string('matricule', 50)->nullable(false)->change();
        });
    }
};