<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class EnsureDepartment
{
    public function handle(Request $request, Closure $next, string $department)
    {
        $user = $request->user();
        if (!$user || $user->department !== $department) {
            abort(403, 'Forbidden for this department.');
        }
        return $next($request);
    }
}
