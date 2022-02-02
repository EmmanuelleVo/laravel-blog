<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

beforeEach(function (){
    $this->post = Post::factory()->create();
    \Illuminate\Support\Facades\Mail::fake();
    $this->comment = [ 'body' => 'comment'];
});

it('is not possible for a non connected user to post a comment', function () {
    $this->post();

    $this->assertDatabaseHas('comments', [
        'body' => 'comment',
    ]);


});

it('checks if a connected user can post a comment', function () {

    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/posts/' . $this->post->slug . '/comments', $this->comment)
        ->assertRedirect('/posts/' . $this->post->slug);

    $this->assertDatabaseHas('comments', $this->comment);

    //\Illuminate\Support\Facades\Mail::assertNothingSent();

});

