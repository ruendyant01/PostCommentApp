<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(10)->create()->each(function($user) {
            $post = Post::factory()->make();
            $user->posts()->save($post);
            $comment = Comment::factory()->make(['post_id' => $post['id']]);
            $user->comments()->save($comment);
            Post::find($post['id'])->comments()->save($comment);
        });
    }
}
