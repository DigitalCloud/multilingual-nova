<?php

namespace Digitalcloud\MultilingualNova\Http\Middleware;

use Digitalcloud\MultilingualNova\NovaLanguageTool;

class Authorize
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
        return resolve(NovaLanguageTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}
