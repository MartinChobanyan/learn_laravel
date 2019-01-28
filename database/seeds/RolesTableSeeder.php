<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_arr = ['goalkeeper','defender','midfielder','attacker','skipper','substitute'];

        foreach($role_arr as $role){
            Role::create([
                "role" => $role,
            ]);
        }
    }
}
