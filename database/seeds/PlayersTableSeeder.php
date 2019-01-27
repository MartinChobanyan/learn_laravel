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
        DB::table('Players')->insert([
            'name' => str_random(10),
            'nick' => str_random(10),
            'secret' => bcrypt('secret'),
        ]);
    }
}
