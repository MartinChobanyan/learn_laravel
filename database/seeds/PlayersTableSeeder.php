<?php

use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\PLayerRole;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = PLayerRole::get();
        for($i=0; $i<10; $i++){
            Player::create([
                'name' => Rand::get('male', '', 4, 15)->name(),
                'nick' => Rand::get('male', '', 4, 15)->surname(),
                'role_id' => ($i % $role->count() + 1),
                'team_id' => random_int(1, 5),
            ]);
        }
    }
}
