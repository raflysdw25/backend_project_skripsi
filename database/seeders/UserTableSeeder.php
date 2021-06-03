<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();


        User::create([
            'nip' => "admin",
            'email' => "admin@test.com",
            "password" => bcrypt("labtik1234"),
            "start_active_period" => \Carbon\Carbon::now(),
            "end_active_period" => \Carbon\Carbon::now(),
            "jabatan_id" => 1,
        ]);
    }
}
