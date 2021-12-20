<?php

namespace Digitalcloud\MultilingualNova\Tests\TestNova;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class TestModel extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Digitalcloud\MultilingualNova\Tests\TestClasses\Models\TestModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            //
        ];
    }

}
