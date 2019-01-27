<?php

namespace Digitalcloud\MultilingualNova;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Multilingual extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'multilingual-nova';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $locales = array_map(function ($value) {
            return __($value);
        }, $this->getSupportLocales());

        $this->setLocales($locales);

    }

    public function fill(NovaRequest $request, $model)
    {
        return ;
    }

    protected function resolveAttribute($resource, $attribute)
    {
        $locales = $this->getLocales();
        $result = [];
        foreach ($locales as $key => $locale) {
            $result[] = [
                'label' => $locale,
                'value' => $key,
                'translated' => in_array($key, array_keys($resource->getTranslations($resource->getTranslatableAttributes()[0])))
            ];
        }

        return [
            'id' => $resource->id,
            'locales' => $result,
            'style' => config('multilingual.style'),
            'convert_to_list_after' => config('multilingual.convert_to_list_after'),
        ];
    }

    public function setLocales(array $locales)
    {
        return $this->withMeta(['locales' => $locales]);
    }

    public function getLocales()
    {
        return $this->meta()["locales"];
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
