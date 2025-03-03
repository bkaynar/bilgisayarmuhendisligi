<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Desteklenen diller
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        // 1. URL'den dil bilgisini kontrol et (örn: /en/about)
        $locale = $request->segment(1);

        if ($locale && in_array($locale, $availableLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            $locale = Session::get('locale', config('app.locale'));
            App::setLocale($locale);
        }

        return $next($request);
    }
}
