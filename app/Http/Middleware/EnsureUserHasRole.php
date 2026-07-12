<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Ensure the authenticated user has one of the allowed roles.
     *
     * Multiple roles may be passed to the middleware, for example:
     * role:super_admin,admin
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        abort_if($user === null, Response::HTTP_UNAUTHORIZED);

        $allowedRoles = array_map(
            fn (string $role): UserRole => UserRole::from($role),
            $roles,
        );

        abort_unless(
            in_array($user->role, $allowedRoles, true),
            Response::HTTP_FORBIDDEN,
        );

        return $next($request);
    }
}