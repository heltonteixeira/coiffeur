<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
        
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@coiffeur.dev',
            'password' => bcrypt('A5S8C7Eu'),
            'admin' => 1,
        ]);
    }
}
