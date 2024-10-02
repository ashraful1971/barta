<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         $users = User::factory(4)->create();

         foreach ($users as $user) {
             $postCount = rand(2, 3);
             $user->posts()->saveMany(Post::factory($postCount)->make());
         }
 
         foreach (Post::all() as $post) {
             $commentCount = rand(0, 4);
             $post->comments()->saveMany(Comment::factory($commentCount)->make([
                 'user_id' => $post->user_id,
             ]));
         }
    }
}
