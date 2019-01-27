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
        for($i=0; $i<5; $i++){
            DB::table('Commands')->insert([
                'name' => str_random(10),
                'losung' => str_random(10),
                'stadium_id' => random_int(1, 5),
                'secret' => bcrypt('secret'),
            ]);
        }
    }
}
