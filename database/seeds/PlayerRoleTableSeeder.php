<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Player;

class PlayerRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(Player::get() as $player){
            DB::table('player_role')->insert([
                'player_id' => random_int(1, Player::get()->count()),
                'role_id' => random_int(1, 6),
            ]);
        }
    }
}
