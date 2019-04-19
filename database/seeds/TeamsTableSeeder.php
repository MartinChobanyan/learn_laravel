<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<5; $i++){
            Team::create([
                'name' => str_random(10),
                'losung' => str_random(10),
                'stadium_id' => random_int(1, 5),
            ]);
        }
    }
}
