<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function initialisation(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => ['requise' => ! User::query()->exists()]]);
    }

    /** Accessible uniquement pour initialiser une instance totalement vide. */
    public function creerPremierAdmin(Request $request): JsonResponse
    {
        if (User::query()->exists()) {
            return response()->json(['success' => false, 'message' => "L'application a déjà été initialisée."], 409);
        }

        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $admin = User::create([
            'nom' => $data['nom'], 'prenom' => $data['prenom'], 'email' => $data['email'],
            'password' => Hash::make($data['password']), 'role' => User::ROLE_ADMIN,
        ]);

        return response()->json(['success' => true, 'message' => 'Administrateur créé. Vous pouvez maintenant vous connecter.', 'data' => $this->userData($admin)], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate(['email' => 'required|email', 'password' => 'required|string']);
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Identifiants invalides.'], 401);
        }
        // Signed, encrypted token: it does not require a personal_access_tokens table.
        $token = Crypt::encryptString(json_encode(['user_id' => $user->id, 'expires_at' => now()->addDays(30)->timestamp], JSON_THROW_ON_ERROR));
        return response()->json(['success' => true, 'message' => 'Connexion réussie.', 'data' => ['token' => $token, 'user' => $this->userData($user)]]);
    }

    public function me(Request $request): JsonResponse { return response()->json(['success' => true, 'data' => $this->userData($request->user())]); }
    public function logout(): JsonResponse { return response()->json(['success' => true, 'message' => 'Déconnexion effectuée.']); }

    private function userData(User $user): array
    {
        return ['id' => $user->id, 'nom' => $user->nom, 'prenom' => $user->prenom, 'name' => $user->nomComplet(), 'email' => $user->email, 'role' => $user->role];
    }
}
