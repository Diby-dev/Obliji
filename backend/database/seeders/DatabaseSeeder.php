<?php

namespace Database\Seeders;

use App\Models\AssignationTache;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@obliji.test'], [
            'nom' => 'Obliji', 'prenom' => 'Admin', 'password' => Hash::make('password'), 'role' => User::ROLE_ADMIN,
        ]);
        $menager = User::firstOrCreate(['email' => 'menager@obliji.test'], [
            'nom' => 'Martin', 'prenom' => 'Alex', 'password' => Hash::make('password'), 'role' => User::ROLE_MENAGER,
        ]);
        $tache = Tache::firstOrCreate(['titre' => 'Nettoyer la cuisine'], [
            'description' => 'Nettoyer les surfaces et le sol.', 'frequence' => 'quotidien',
        ]);
        AssignationTache::firstOrCreate(['tache_id' => $tache->id, 'menager_id' => $menager->id], [
            'admin_id' => $admin->id, 'statut' => AssignationTache::STATUT_A_FAIRE, 'date_echeance' => now()->addDay(),
        ]);
    }
}
