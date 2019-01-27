<?php

namespace Digitalcloud\MultilingualNova;

use Digitalcloud\MultilingualNova\Http\Middleware\Authorize;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-language-tool');

        $lang = request('lang', request()->header('lang'));

        if ($lang) app()->setLocale($lang);

        Nova::serving(function (ServingNova $event) {
            Nova::provideToScript(['locals' => $this->getSupportLocales(), 'currentLocal' => App::getLocale()]);
            Nova::script('multilingual-nova', __DIR__ . '/../dist/js/field.js');
            Nova::style('multilingual-nova', __DIR__ . '/../dist/css/field.css');
        });

        // Publish a config file
        $this->publishes([
            __DIR__ . '/../config/multilingual.php' => config_path('multilingual.php'),
        ], 'config');

        $this->app->booted(function () {
            $this->routes();
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/multilingual.php', 'multilingual');
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/multilingual-nova')
            ->group(__DIR__.'/../routes/api.php');
    }


    private function getSupportLocales()
    {
        if (config('multilingual.source') == 'array') return config('multilingual.locales');

        if (config('multilingual.source') == 'database') {
            $model = config('multilingual.database.model');
            $code = config('multilingual.database.code_field');
            $label = config('multilingual.database.label_field');

            $locales = ($model)::all()->mapWithKeys(function ($item) use ($code, $label) {
                return [$item->$code => $item->$label];
            });
            return $locales->toArray();
        }

        return ['en' => 'EN'];
    }
}
