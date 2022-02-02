<?php

it('has hello page', function () {
    $response = $this->get('/hello');

    $response->assertStatus(200);
    $response->assertSee('Hello');
}); //->throws(\Whoops\Exception\ErrorException::class)

