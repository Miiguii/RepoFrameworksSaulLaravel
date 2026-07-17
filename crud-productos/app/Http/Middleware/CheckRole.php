<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, mixed ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            logger()->warning('Role middleware blocked unauthenticated access', [
                'path' => $request->path(),
                'ip' => $request->ip(),
            ]);

            abort(403, 'No autorizado.');
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        logger()->warning('Role middleware blocked unauthorized access', [
            'user_id' => $user->id,
            'user_role' => $user->role?->tipo,
            'required_roles' => $roles,
            'path' => $request->path(),
            'ip' => $request->ip(),
        ]);

        abort(403, 'No tienes permisos para acceder a esta sección.');
    }
}
