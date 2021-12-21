<?php

use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Support\Facades\Config;
use function Pest\Faker\faker;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    Config::set('nova', ['path' => '/admin']);
});

function getFieldName()
{
    return 'Language';
}

function handleSetLocalesMultilingual()
{
    $multilingual = (new Multilingual(getFieldName()));
    $locales = ['en' => 'EN', 'ar' => 'AR'];
    $multilingual->setLocales($locales);
    $allLocales = $multilingual->getLocales();

    return [$locales, $allLocales];
}

it('can get locales', function () {
    $locales = (new Multilingual(getFieldName()))->getLocales();

    assertTrue(in_array('EN', $locales));
});

it('cant get locales', function () {
    $locales = (new Multilingual(getFieldName()))->getLocales();
    assertFalse(in_array(faker()->title, $locales));
});

it('can set locales', function () {
    [$locales, $allLocales] = handleSetLocalesMultilingual();
    foreach ($locales as $key => $value) {
        assertTrue(isset($allLocales[$key]) && $value == $allLocales[$key]);
    }
});

it('cant set locales', function () {
    [$locales, $allLocales] = handleSetLocalesMultilingual();
    $allLocales['ar'] = faker()->title;
    $allLocales['en'] = faker()->title;
    foreach ($locales as $key => $value) {
        assertFalse(isset($allLocales[$key]) && $value == $allLocales[$key]);
    }
});
