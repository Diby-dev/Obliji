<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class OblijiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = json_decode(Crypt::decryptString((string) $request->bearerToken()), true, 512, JSON_THROW_ON_ERROR);
            if (($payload['expires_at'] ?? 0) < now()->timestamp) throw new \RuntimeException('expired');
            $user = User::findOrFail($payload['user_id'] ?? null);
            $request->setUserResolver(fn () => $user);
        } catch (\Throwable) {
            return response()->json(['success' => false, 'message' => 'Session invalide ou expirée.'], 401);
        }
        return $next($request);
    }
}
