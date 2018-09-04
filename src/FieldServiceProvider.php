<?php

namespace Digitalcloud\MultilingualNova;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $lang = request('lang', request()->header('lang'));

        if ($lang) app()->setLocale($lang);

        Nova::serving(function (ServingNova $event) {
            Nova::script('multilingual-nova', __DIR__ . '/../dist/js/field.js');
            Nova::style('multilingual-nova', __DIR__ . '/../dist/css/field.css');
        });

        // Publish a config file
        $this->publishes([
            __DIR__ . '/../config/multilingual.php' => config_path('multilingual.php'),
        ], 'multilingual-nova');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
