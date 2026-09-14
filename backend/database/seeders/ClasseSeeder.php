<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // On importe la Facade Schema

class ClasseSeeder extends Seeder
{
    /**
     * Exécute l'ensemencement de la base de données.
     */
    public function run(): void
    {
        // 1. On dit à MySQL de désactiver temporairement la vérification des clés étrangères
        Schema::disableForeignKeyConstraints();

        // Supprimer toutes les classes existantes avant d'insérer les nouvelles
        DB::table('classes')->truncate();

        // 2. On réactive immédiatement la sécurité après le truncate
        Schema::enableForeignKeyConstraints();

        // Définition des classes courantes
        $classes = [
            // Premier cycle
            ['nom_classe' => '6ème Glory', 'type_classe' => 'Collège'],
            ['nom_classe' => '6ème Adoration', 'type_classe' => 'Collège'],
            ['nom_classe' => '5ème Goodness', 'type_classe' => 'Collège'],
            ['nom_classe' => '5ème Charity', 'type_classe' => 'collège'],
            ['nom_classe' => '4ème Honesty', 'type_classe' => 'Collège'],
            ['nom_classe' => '4ème Loyalty', 'type_classe' => 'Collège'],
            ['nom_classe' => '3ème', 'type_classe' => 'Collège'],

            // Second cycle (Exemple pour un lycée)
            ['nom_classe' => '2nde A', 'type_classe' => 'lycée'],
            ['nom_classe' => '2nde C', 'type_classe' => 'lycée'],
            ['nom_classe' => '1ere A', 'type_classe' => 'lycée'],
            ['nom_classe' => '1ere D', 'type_classe' => 'lycée'],

            // Primaire
            ['nom_classe' => 'CM2 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CM1 B', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CM1 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CE2 B', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CE2 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CE2 C', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CE1 B', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CE1 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP1 B', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP1 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP1 C', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP2 A', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP2 B', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CP2 C', 'type_classe' => 'primaire'],
            ['nom_classe' => 'CM2 B', 'type_classe' => 'primaire'],
        ];

        // Insérer les données dans la table 'classes'
        DB::table('classes')->insert($classes);
    }
}
