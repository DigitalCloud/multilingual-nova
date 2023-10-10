<?php

namespace Digitalcloud\MultilingualNova\Http\Middleware;

use DigitalCloud\MultilingualNova\NovaLanguageTool;

class InitializeLanguage
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if (session()->has('lang'))
            app()->setLocale(session()->get('lang'));
        return $next($request);
    }
}
