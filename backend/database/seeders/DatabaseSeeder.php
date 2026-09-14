<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Importez tous les seeders que vous utilisez
use Database\Seeders\ClasseSeeder; 
use Database\Seeders\ElevesSeeder; // 👈 NOUVEAU : Importez votre ElevesSeeder

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Utilisez la méthode call() pour exécuter vos seeders dans l'ordre de dépendance
        $this->call([
            // 1. Les Classes doivent être insérées en premier
            ClasseSeeder::class, 

            // 2. Les Élèves doivent être insérés après les classes
            ElevesSeeder::class, // 👈 AJOUTÉ : Pour insérer vos 300 élèves
        ]);
        
        // --- DONNÉES UTILISATEURS ---
        
        // 3. Création de l'utilisateur de test (conservé)
        // Note: Si UserSeeder existe, vous pourriez l'ajouter ci-dessus.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        // Si vous avez d'autres utilisateurs à créer:
        // User::factory(10)->create(); 
    }
}