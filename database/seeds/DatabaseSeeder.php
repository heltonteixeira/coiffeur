<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->command->info('Users table seeded!');
        $this->call(ClientsTableSeeder::class);
        $this->command->info('Clients table seeded!');
        $this->call(ServicesTableSeeder::class);
        $this->command->info('Services table seeded!');
        $this->call(JobsTableSeeder::class);
        $this->command->info('Jobs table seeded!');
    }
}
