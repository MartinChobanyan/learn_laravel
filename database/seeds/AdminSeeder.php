<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.org',
            'phone' => '',
            'skype' => 'live:admin@admin.org',
            'roles' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
