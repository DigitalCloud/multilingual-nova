<?php

use Digitalcloud\MultilingualNova\Http\Middleware\Authorize;
use function Pest\Laravel\getJson;
use function Pest\Laravel\withoutMiddleware;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    withoutMiddleware(['nova', Authorize::class]);
});

it('get current local', function () {
    $response = getJson('nova-vendor/multilingual-nova/current-local');

    assertEquals('en', $response->content());
});