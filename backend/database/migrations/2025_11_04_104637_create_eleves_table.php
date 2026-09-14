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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id(); // id_eleves
            
            // Identification
            $table->string('matricule', 50)->unique();
            $table->string('nom');
            $table->string('prenoms');
            $table->date('date_naissance');
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->enum('sexe', ['Masculin', 'Féminin']);
            
            // Contact et Informations de fichier
            $table->string('tuteur_telephone', 15);
            $table->string('email')->nullable(); 
            $table->string('photo_url')->nullable(); 
            
            // Clé étrangère
            $table->foreignId('classe_id')
                  ->constrained('classes') 
                  ->cascadeOnDelete();
            
            // Options scolaires
            $table->boolean('redouble')->default(false);
            $table->boolean('affecte')->default(false);
            $table->string('lv2', 100)->nullable();
            $table->string('ap_mu', 100)->nullable();
            
            // ✅ Champ manquant ajouté
            $table->string('preced_classe', 30)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Inverse les migrations (supprime la table).
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};