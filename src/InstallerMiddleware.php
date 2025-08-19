<?php

namespace Kamrankhandev\Installer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstallerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If the app is not installed
        if (!config()->has('settings.title')) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
