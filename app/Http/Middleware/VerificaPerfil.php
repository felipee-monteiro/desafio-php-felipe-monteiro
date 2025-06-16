<?php

declare(strict_types=1);

namespace App\Http\Middleware;

class VerificaPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param mixed                                                                            $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param mixed                                                                            $perfil
     */
    public function handle($request, \Closure $next, $perfil): \Symfony\Component\HttpFoundation\Response
    {
        if (auth()->user()->role !== $perfil) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
