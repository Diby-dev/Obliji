<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations (crée la table).
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            // Clé primaire conventionnelle de Laravel (id)
            $table->id(); 
            
            // Colonnes de la table classe
            $table->string('nom_classe', 30)->unique();
            $table->string('type_classe', 30)->nullable();
            
            // Colonnes de temps pour Laravel
            $table->timestamps(); 
        });
    }

    /**
     * Inverse les migrations (supprime la table).
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};