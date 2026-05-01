<?php

test('/login returns a successful response', function () {
    $response = $this->get('/login');

    $response->assertOk();
});

test('/register returns a successful response', function () {
    $response = $this->get('/register');

    $response->assertOk();
});

test('/ return login redirect while unauthenticated', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
