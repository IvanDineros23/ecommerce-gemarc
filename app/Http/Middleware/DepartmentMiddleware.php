<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DepartmentMiddleware
{
    public function handle(Request $request, Closure $next, $department)
    {
        $user = Auth::user();
        if (!$user || $user->department !== $department) {
            abort(403, 'Unauthorized. Department access only.');
        }
        return $next($request);
    }
}
