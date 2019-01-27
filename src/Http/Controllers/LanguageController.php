<?php

namespace Digitalcloud\MultilingualNova\Http\Controllers;

use Illuminate\Support\Facades\App;

class LanguageController extends Controller {

    public function index() {

    }
    public function currentLocal() {
        return App::getLocale();
    }

    public function locals() {
        return App::getLocale();
    }
}
