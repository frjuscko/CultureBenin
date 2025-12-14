<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Moderateur
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Vérifier le rôle (libellé)
        if ($request->user()->getRole->libelle !== "Moderateur") {
            return redirect('/');
        }

        return $next($request);
    }
}
