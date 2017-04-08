<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number = App\Client::count();

        factory('App\Job', mt_rand($number, $number + mt_rand(10, 30)))->create();
    }
}
