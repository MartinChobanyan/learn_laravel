<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StadiumsTableSeeder::class,
            TeamsTableSeeder::class,
            PlayersTableSeeder::class,
            RolesTableSeeder::class,
            PlayerRoleTableSeeder::class,
            AdminSeeder::class,
            // PostsTableSeeder::class
        ]);
    }
}
