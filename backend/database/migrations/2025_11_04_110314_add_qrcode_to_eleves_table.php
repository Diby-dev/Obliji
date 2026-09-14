<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            // Ajoute la colonne 'qrcode' de type string (longueur de 255 caractères)
            // Nous le rendons nullable car les anciens enregistrements n'en auront pas.
            $table->string('qrcode', 255)->nullable()->after('matricule'); 
            // Nous utilisons ->after('matricule') pour le placer juste après la colonne 'matricule'
        });
    }

    /**
     * Inverse les migrations.
     */
    public function down(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            // Supprime la colonne 'qrcode'
            $table->dropColumn('qrcode');
        });
    }
};