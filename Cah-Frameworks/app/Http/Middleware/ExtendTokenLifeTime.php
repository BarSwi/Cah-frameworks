<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class ExtendTokenLifeTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     //Extends the auth-token by another 2hours when user is actively using website
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (Auth::guard('sanctum')->check()) {
           
            $user = Auth::guard('sanctum')->user();
            $token = $user->currentAccessToken();
            // Extend tokens expiration times
            if($token->can('remember')) return $response;
            $token->forceFill([
                'expires_at' => now()->addMinutes(120),
            ])->save();
        }

        return $response;
    }
}