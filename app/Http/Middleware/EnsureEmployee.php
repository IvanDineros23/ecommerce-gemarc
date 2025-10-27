<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class EnsureEmployee
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || $user->role !== 'employee') {
            abort(403, 'Employees only.');
        }
        return $next($request);
    }
}
