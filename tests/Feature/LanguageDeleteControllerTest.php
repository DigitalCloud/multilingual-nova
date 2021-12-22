<?php

use Digitalcloud\MultilingualNova\Http\Middleware\Authorize;
use Digitalcloud\MultilingualNova\Tests\TestClasses\Models\TestModel;
use Digitalcloud\MultilingualNova\Tests\TestNova\TestModel as TestNova;
use Laravel\Nova\Nova;
use function Pest\Faker\faker;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\withoutMiddleware;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    withoutMiddleware(['nova', Authorize::class]);
    Nova::resources(['test-models' => TestNova::class]);
});

/**
 * @return string
 */
function baseUrl()
{
    return 'nova-vendor/multilingual-nova/remove-local/en';
}

/**
 * @return string
 */
function messageError()
{
    return 'Server Error';
}

it('delete local', function () {

    $resource = TestModel::create(['title' => ['en' => faker()->title, 'ar' => faker()->title]]);

    $response = deleteJson(baseUrl(), [
        'resourceName' => 'test-models',
        'resourceId' => $resource->id,
    ]);

    assertTrue(json_decode($response->content())->status);
});

it('cant delete local when resource name invalid', function () {

    $resource = TestModel::create(['title' => ['en' => faker()->title, 'ar' => faker()->title]]);

    $response = deleteJson(baseUrl(), [
        'resourceName' => 'test',
        'resourceId' => $resource->id,
    ]);

    assertEquals(json_decode($response->content())->message, messageError());
});

it('cant delete local when resource id invalid', function () {

    $response = deleteJson(baseUrl(), [
        'resourceName' => 'test-models',
        'resourceId' => 0,
    ]);

    assertEquals(json_decode($response->content())->message, messageError());
});
