<?php

use Illuminate\Database\Seeder;

class CommandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Commands')->insert([
            'name' => str_random(10),
            'losung' => str_random(10),
            'secret' => bcrypt('secret'),
        ]);
    }
}
