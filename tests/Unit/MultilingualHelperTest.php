<?php

use Digitalcloud\MultilingualNova\Helper\MultilingualHelper;
use Digitalcloud\MultilingualNova\Tests\TestClasses\Models\TestModel;
use Illuminate\Support\Facades\Config;
use function PHPUnit\Framework\assertTrue;

function handleConfigMultilingual(array $data)
{
    Config::set('multilingual', $data);
}

it('can get support locales when source not array or database', function () {
    handleConfigMultilingual(['source' => null]);
    $allLocales = MultilingualHelper::getSupportLocales();
    assertTrue(in_array('EN', $allLocales));
});

it('can get support locales when source array', function () {
    $locales = ['en' => 'EN', 'ar' => 'AR'];
    handleConfigMultilingual(['source' => 'array', 'locales' => $locales]);
    $allLocales = MultilingualHelper::getSupportLocales();
    foreach ($locales as $key => $value) {
        assertTrue(isset($allLocales[$key]) && $value == $allLocales[$key]);
    }
});

it('can get support locales when source database', function () {
    $locales = ['en' => 'English', 'ar' => 'Arabic'];

    foreach ($locales as $code => $label) {
        TestModel::create(['code' => $code, 'label' => $label]);
    }

    handleConfigMultilingual(['source' => 'database', 'database' => [
        'model' => TestModel::class,
        'code_field' => 'code',
        'label_field' => 'label',
    ]]);

    $allLocales = MultilingualHelper::getSupportLocales();
    foreach ($locales as $key => $value) {
        assertTrue(isset($allLocales[$key]) && $value == $allLocales[$key]);
    }
});
