<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LocallyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $languageLocale = [ 'en' , 'np' ];
        $locale = session('APP_LOCALE');
        $locale = in_array($locale, $languageLocale) ? $locale : config('app.locale');
        app()->setLocale($locale);
        return $next($request);
    }
}