<?php

namespace stvnrlnd\Press\Tests;

use stvnrlnd\Press\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SavePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created()
    {
        $post = factory(Post::class)->create();

        $this->assertCount(
            1, 
            Post::all()
        );
    }
}
