<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ----------------------
        // POST size skip
        // ----------------------
        // Laravel normally throws PostTooLargeException if PHP post_max_size exceeded
        // We temporarily remove CONTENT_LENGTH so Laravel doesn't throw
        if (isset($_SERVER['CONTENT_LENGTH'])) {
            // Set to 0 to effectively skip POST size check
            $_SERVER['CONTENT_LENGTH'] = 0;
        }

        // ----------------------
        // Original admin check
        // ----------------------
        if (auth()->user()) {
            $is_admin = auth()->user()->is_admin;
            if ($is_admin) {
                return $next($request);
            }
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }
}