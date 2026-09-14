<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // La clé primaire (user_id)
            
            // Colonnes requises par l'authentification et le seeder
            $table->string('name');
            $table->string('email')->unique(); // L'email doit être unique
            $table->timestamp('email_verified_at')->nullable(); // Pour la vérification d'email
            $table->string('password');
            $table->rememberToken()->nullable(); // Pour la fonction "Se souvenir de moi"
            
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};