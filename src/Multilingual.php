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

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $locales = array_map(function ($value) {
            return __($value);
        }, config('translatable.locales'));

        $this->setLocales($locales);
    }

    protected function resolveAttribute($resource, $attribute)
    {
        $locales = $this->getLocales();

        return [
            'id' => $resource->id,
            'locales' => [
                [
                    'label' => 'EN',
                    'value' => 'en',
                    'translated' => true,
                ],
                [
                    'label' => 'AR',
                    'value' => 'ar',
                    'translated' => false,
                ]
            ]
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
}
