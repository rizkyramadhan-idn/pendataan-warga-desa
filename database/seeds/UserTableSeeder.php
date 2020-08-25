<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "job_id" => 4,
            "name" => "Satria Baja Hitam",
            "email" => "satriabajahitam@gmail.com",
            "password" => bcrypt(12345678),
            "image" => "avatar-1.png",
            "gender" => false,
            "phone_number" => "081234567890"
        ]);

        User::create([
            "job_id" => 3,
            "name" => "Jessica Veranda",
            "email" => "jessicaveranda@gmail.com",
            "password" => bcrypt(12345678),
            "image" => "avatar-1.png",
            "gender" => true,
            "phone_number" => "081234567890"
        ]);
    }
}