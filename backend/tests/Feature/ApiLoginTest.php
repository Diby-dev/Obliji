<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_route_returns_a_token_for_valid_credentials(): void
    {
        User::query()->create([
            'nom' => 'Admin',
            'prenom' => 'Administrateur',
            'email' => 'admin@example.test',
            'password' => Hash::make('secret-password'),
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.test',
            'password' => 'secret-password',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.user.role', User::ROLE_ADMIN)
            ->assertJsonStructure(['data' => ['token']]);
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'unknown@example.test',
            'password' => 'wrong-password',
        ]);

        $response
            ->assertUnauthorized()
            ->assertJsonPath('success', false);
    }

    public function test_empty_instance_can_create_its_first_administrator_only_once(): void
    {
        $this->getJson('/api/initialisation')
            ->assertOk()
            ->assertJsonPath('data.requise', true);

        $this->postJson('/api/initialisation/admin', [
            'nom' => 'Dupont',
            'prenom' => 'Alice',
            'email' => 'alice@example.test',
            'password' => 'un-mot-de-passe-solide',
            'password_confirmation' => 'un-mot-de-passe-solide',
        ])
            ->assertCreated()
            ->assertJsonPath('data.role', User::ROLE_ADMIN);

        $this->postJson('/api/initialisation/admin', [
            'nom' => 'Autre', 'prenom' => 'Admin', 'email' => 'autre@example.test',
            'password' => 'un-mot-de-passe-solide', 'password_confirmation' => 'un-mot-de-passe-solide',
        ])->assertConflict();
    }
}
