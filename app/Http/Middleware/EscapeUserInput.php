<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EscapeUserInput
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        foreach ($request->all() as $key => $value) {
            if (\is_string($value) && filled($value)) {
                $request->merge([
                    $key => e($value),
                ]);
            }
        }

        return $next($request);
    }
}
