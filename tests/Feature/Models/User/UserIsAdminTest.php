<?php

use App\Models\User;
use Illuminate\Support\Str;

it('allows an admin user to access admin of posts', function () {

    $user = User::factory()->create([
        'username' => Str::slug('Emmanuelle Vo'),
    ]);

    actingAs($user)->get('admin/posts')
        ->assertSee('Manage Posts')
        ->assertStatus(200);
});

it('prevents a non admin user to access admin of posts', function () {

    $response = $this->get('admin/posts')->assertSee('unauthorized');
    $response->assertStatus(403);
});
