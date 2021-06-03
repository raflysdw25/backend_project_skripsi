<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::truncate();


        Staff::create([
            "nip" => "admin",
            "staff_fullname" => "Super Admin",
            "email" => "admintest@gmail.com",
            "phone_number" => "025100090000",
            "address" => "",
            "prodi_id" => null,
        ]);
    }
}
