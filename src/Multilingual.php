<?php

namespace Digitalcloud\MultilingualNova;

use Laravel\Nova\Fields\Field;

class Multilingual extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'multilingual-nova';

    public $showOnCreation = false;
    public $showOnUpdate = false;

    protected function resolveAttribute($resource, $attribute)
    {
        $locales = config("translatable.locales");
        $result = [];
        foreach ($locales as $key => $locale) {
            $result[] = [
                'label' => $locale,
                'value' => $key,
                'translated' => in_array($key, array_keys($resource->getTranslations($resource->translatable[0])))
            ];
        }
        return [
            'id' => $resource->id,
            'locales' => $result
        ];
    }
}
