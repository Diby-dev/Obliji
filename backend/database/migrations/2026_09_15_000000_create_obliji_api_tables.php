<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('menager')->index();
            $table->string('telephone', 30)->nullable();
        });

        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('piece', 100);
            $table->string('frequence', 50)->nullable();
            $table->unsignedInteger('duree_estimee')->nullable();
            $table->string('difficulte', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('assignations_taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('tache_id')->constrained('taches')->cascadeOnDelete();
            $table->string('statut', 20)->default('a_faire')->index();
            $table->date('date_echeance')->index();
            $table->timestamp('date_completion')->nullable();
            $table->text('commentaires')->nullable();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('titre');
            $table->text('message');
            $table->boolean('lu')->default(false)->index();
            $table->string('type', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('assignations_taches');
        Schema::dropIfExists('taches');

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn(['role', 'telephone']);
        });
    }
};
