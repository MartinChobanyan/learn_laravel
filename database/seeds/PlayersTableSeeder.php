<?php

use Illuminate\Database\Seeder;

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
            DB::table('Players')->insert([
                'name' => str_random(10),
                'nick' => str_random(10),
                'command_id' => random_int(1, 5),
                'secret' => bcrypt('secret'),
            ]);
        }
    }
}
