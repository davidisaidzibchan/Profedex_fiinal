<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthProfedex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            $isMobile = $this->isMobileDevice($request);
            if ($isMobile) {
                return redirect()->route('login');
            } else {
                return redirect('/');
            }
        }
        return $next($request);
    }
    private function isMobileDevice($request)
    {
        return preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $request->header('User-Agent'));
    }
}
