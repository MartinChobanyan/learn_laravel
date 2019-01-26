<?php

use Illuminate\Database\Seeder;

class Some_tableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('some_table')->instert([
            'some_int_data' => rand(5, 10),
            'some_string_data' =>  str_random(5),
        ]);
    }
}
