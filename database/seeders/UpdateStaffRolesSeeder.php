<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateStaffRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asignar role_id = 1 al usuario con staff_id = 1
        DB::table('staff')->where('staff_id', 1)->update(['role_id' => 1]);

        // Asignar role_id = 2 al resto de los usuarios
        DB::table('staff')->where('staff_id', '!=', 1)->update(['role_id' => 2]);
    }
}
