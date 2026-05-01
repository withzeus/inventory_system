<?php

test('login endpoint returns a successful response', function () {
    $response = $this->get('/login');

    $response->assertOk();
});

test('register endpoint returns successful response', function () {
    $response = $this->get('/register');

    $response->assertOk();
});

test('guest is redirected from home to login', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
