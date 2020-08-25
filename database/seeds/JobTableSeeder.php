<?php

use App\Job;
use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::create([
            "name" => "Wirausaha"
        ]);

        Job::create([
            "name" => "Wiraswasta"
        ]);

        Job::create([
            "name" => "Freelance"
        ]);

        Job::create([
            "name" => "Pelajar"
        ]);
    }
}