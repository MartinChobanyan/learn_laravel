<?php

use Illuminate\Database\Seeder;

class StadiumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<5; $i++){
            App\Models\Stadium::create([
                'name' => str_random(10),
                'max_visitors' => random_int(5000, 10000),
                'width' => random_int(1, 1000),
                'length' => random_int(500, 1000),
                'secret' => bcrypt('secret'),
            ]);
        }
    }
}
