<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class VerificaPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param mixed                                                                            $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param mixed                                                                            $perfil
     */
    public function handle($request, \Closure $next, $perfil)
    {
        if (auth()->user()->role !== $perfil) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
