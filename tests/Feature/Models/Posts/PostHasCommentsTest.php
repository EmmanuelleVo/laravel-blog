<?php

use App\Models\Comment;
use App\Models\Post;

it('can check if posts have comments', function () {
    // Arrange - create things
    $comment = Comment::factory()->count(1);
    $post = Post::factory()
        ->has($comment)
        ->create();

    // Act


    // Assert

    $this->assertModelExists($post);
    $this->assertCount(1, $post->comments);

    expect($post->hasComments())->toBeTrue();
    // = $this->assertTrue($post->hasComments());

    // Arrange
    $post = Post::factory()->create();

    // Assert
    $this->assertFalse($post->hasComments());


});
