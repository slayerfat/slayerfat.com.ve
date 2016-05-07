<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Post $posts */
        $posts = factory(Post::class, 5)->create();

        foreach ($posts as $post) {
            $post->tags()->attach([1, 2, 3]);
        }
    }
}
