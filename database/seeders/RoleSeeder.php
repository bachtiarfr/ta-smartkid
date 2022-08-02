<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "pengawas",
                "guard_name" => "web"
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
