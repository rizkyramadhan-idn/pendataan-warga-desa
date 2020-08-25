<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   
    {
        Admin::create([
            "name" => "Admin",
            "email" => "admin@pendataan-warga.com",
            "password" => bcrypt(12345678),
            "image" => "avatar-1.png"
        ]);
    }
}