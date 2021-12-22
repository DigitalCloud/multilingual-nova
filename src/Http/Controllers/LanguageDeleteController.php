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

        abort_if(!$resourceClass, "Missing resource class");

        $modelClass = $resourceClass::$model;

        $resource = $modelClass::find($request->get("resourceId"));

        abort_if(!$resource, "Missing resource");

        if ($resource->forgetAllTranslations($locale)->save()) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }
}
