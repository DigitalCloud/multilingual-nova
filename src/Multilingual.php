<?php

namespace Digitalcloud\MultilingualNova;

use Digitalcloud\MultilingualNova\Helper\MultilingualHelper;
use Illuminate\Support\Facades\App;
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
        }, MultilingualHelper::getSupportLocales());

        $this->setLocales($locales);
        $this->withMeta(['url' => config('nova.path')]);
    }

    public function fill(NovaRequest $request, $model)
    {
        return null;
    }

    protected function resolveAttribute($resource, $attribute)
    {
        $localeCurrent = App::getLocale();

        $locales = $this->getLocales();
        $result = [];
        foreach ($locales as $key => $locale) {
            $isTranslated = false;
            foreach ($resource->getTranslatableAttributes() as $value) {
                $isTranslated = in_array($key, array_keys($resource->getTranslations($value)));
                if ($isTranslated) {
                    break;
                }
            }

            $result[] = [
                'label' => $locale,
                'value' => $key,
                'selected' => ($localeCurrent === $key) ? true : false,
                'translated' => $isTranslated
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

}
