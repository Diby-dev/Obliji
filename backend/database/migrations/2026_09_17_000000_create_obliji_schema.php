<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** This migration mirrors the PostgreSQL schema supplied for Obliji. */
    public function up(): void
    {
        // Neon already contains this schema in production: never attempt to alter it.
        if (Schema::hasTable('users')) return;

        if (DB::getDriverName() === 'pgsql') {
            DB::unprepared(<<<'SQL'
                CREATE TYPE user_role AS ENUM ('admin', 'menager');
                CREATE TYPE task_status AS ENUM ('a_faire', 'en_cours', 'termine', 'valide');
                CREATE TABLE users (
                    id SERIAL PRIMARY KEY, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL,
                    role user_role NOT NULL DEFAULT 'menager',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
                CREATE TABLE taches (
                    id SERIAL PRIMARY KEY, titre VARCHAR(150) NOT NULL, description TEXT,
                    frequence VARCHAR(50) DEFAULT 'ponctuel',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
                CREATE TABLE assignations_taches (
                    id SERIAL PRIMARY KEY,
                    tache_id INT NOT NULL REFERENCES taches(id) ON DELETE CASCADE,
                    menager_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
                    admin_id INT REFERENCES users(id) ON DELETE SET NULL,
                    statut task_status DEFAULT 'a_faire', date_echeance TIMESTAMP,
                    commentaire_realisation TEXT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
                CREATE TABLE notifications (
                    id SERIAL PRIMARY KEY, user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
                    titre VARCHAR(150) NOT NULL, message TEXT NOT NULL, lu BOOLEAN DEFAULT FALSE,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
                SQL);
            return;
        }

        // Keeps the automated test suite runnable on SQLite; production uses PostgreSQL above.
        DB::unprepared("CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(20) NOT NULL DEFAULT 'menager', created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
        DB::unprepared("CREATE TABLE taches (id INTEGER PRIMARY KEY AUTOINCREMENT, titre VARCHAR(150) NOT NULL, description TEXT, frequence VARCHAR(50) DEFAULT 'ponctuel', created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
        DB::unprepared("CREATE TABLE assignations_taches (id INTEGER PRIMARY KEY AUTOINCREMENT, tache_id INTEGER NOT NULL REFERENCES taches(id) ON DELETE CASCADE, menager_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE, admin_id INTEGER REFERENCES users(id) ON DELETE SET NULL, statut VARCHAR(20) DEFAULT 'a_faire', date_echeance DATETIME, commentaire_realisation TEXT, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
        DB::unprepared("CREATE TABLE notifications (id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE, titre VARCHAR(150) NOT NULL, message TEXT NOT NULL, lu BOOLEAN DEFAULT FALSE, created_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('assignations_taches');
        Schema::dropIfExists('taches');
        Schema::dropIfExists('users');
        if (DB::getDriverName() === 'pgsql') {
            DB::unprepared('DROP TYPE IF EXISTS task_status; DROP TYPE IF EXISTS user_role;');
        }
    }
};
