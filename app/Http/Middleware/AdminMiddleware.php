<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | User is not logged in
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }


        /*
        |--------------------------------------------------------------------------
        | User is logged in but is not admin
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }


        /*
        |--------------------------------------------------------------------------
        | User is admin
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}