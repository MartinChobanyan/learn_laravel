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
                'photo' => 'https://static1.squarespace.com/static/53adb125e4b094aac18a8ee7/t/5b8ee8a7575d1f5df42a02d0/1536092505155/F1SavannahCat-7.jpg?format=500w',
                'title' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi',
                'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi adipisci aliquam quo ex accusamus nesciunt iure maxime sed aspernatur. Perferendis quaerat eum id ex officia laboriosam tempora culpa asperiores omnis?'
            ]);
        }
    }
}
