<?php

namespace Digitalcloud\MultilingualNova\Http\Controllers;

use Illuminate\Http\Request;
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

    public function setLocal(Request $request) {
        session()->put('lang', $request->lang);
        return $request->lang ;
    }

}
