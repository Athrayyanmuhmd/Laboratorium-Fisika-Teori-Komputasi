<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Super Admin should use their own dashboard, redirect them
        if ($user->isSuperAdmin()) {
            return redirect()->route('super-admin.dashboard')->with('info', 'Anda dialihkan ke Super Admin Dashboard.');
        }
        
        // Allow lab_admin and dosen roles only
        if (!$user->isLabAdmin() && $user->role !== 'dosen') {
            abort(403, 'Unauthorized. Lab Admin access required.');
        }

        return $next($request);
    }
}
