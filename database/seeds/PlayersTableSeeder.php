<?php

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; $i++){
            Player::create([
                'name' => Rand::get('male', '', 4, 15)->name(),
                'nick' => Rand::get('male', '', 4, 15)->surname(),
                'role_id' => random_int(1, 7),
                'team_id' => random_int(1, 5),
                'secret' => bcrypt('secret'),
            ]);
        }
    }
}
