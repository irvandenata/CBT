<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'irvandenata',
            'email' => 'irvandta@gmail.com',
            'role_id' => 1,
            'password' => app('hash')->make('password'),

        ]);
    }
}
