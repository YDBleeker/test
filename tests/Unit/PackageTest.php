<?php

test('get the service provider', function () {
    $this->assertTrue(class_exists(\Yonidebleeker\Webinsights\WebinsightsServiceProvider::class));
});

test('get the controller', function () {
    $this->assertTrue(class_exists(\Yonidebleeker\Webinsights\Http\Controllers\WebinsightsController::class));
});

test('get cookies from request', function () {
    $request = new \Illuminate\Http\Request();
    $request->cookies->set('test', 'test');

    $this->assertTrue($request->cookies->has('test'));
});