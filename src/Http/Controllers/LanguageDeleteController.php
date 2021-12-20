<?php

namespace Digitalcloud\MultilingualNova\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;

class LanguageDeleteController extends Controller
{
    /**
     * @param Request $request
     * @param $locale
     * @return mixed
     */
    public function __invoke(Request $request, $locale)
    {
        $resourceClass = Nova::resourceForKey($request->get("resourceName"));

        if (!$resourceClass) {
            abort("Missing resource class");
        }

        $modelClass = $resourceClass::$model;

        $resource = $modelClass::find($request->get("resourceId"));

        if (!$resource) {
            abort("Missing resource");
        }

        if ($resource->forgetAllTranslations($locale)->save()) {
            return response()->json(["status" => true]);
        }

        abort("Error saving");
    }
}
