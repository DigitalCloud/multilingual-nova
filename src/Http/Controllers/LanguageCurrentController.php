<?php

namespace Digitalcloud\MultilingualNova\Http\Controllers;

use Illuminate\Support\Facades\App;

class LanguageCurrentController extends Controller
{
    /**
     * @return string
     */
    public function __invoke()
    {
        return App::getLocale();
    }

}
