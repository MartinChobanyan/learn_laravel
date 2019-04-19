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
                'photo' => 'images/test.jpg',
                'title' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi',
                'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi adipisci aliquam quo ex accusamus nesciunt iure maxime sed aspernatur. Perferendis quaerat eum id ex officia laboriosam tempora culpa asperiores omnis?',
            ]);
        }
    }
}
