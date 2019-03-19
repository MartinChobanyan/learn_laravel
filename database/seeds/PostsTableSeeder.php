<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(User::get() as $user){
            Post::create([
                'author_id' => $user->id,
                'photo' => bcrypt('photo'),
                'title' => bcrypt('title'),
                'content' => bcrypt('content')
            ]);
        }
    }
}
