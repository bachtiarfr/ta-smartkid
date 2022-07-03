<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\OrangTua;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "ryan",
            "email" => "ryan@gmail.com",
            "password" => bcrypt('rahasia123')
        ]);

        $role = Role::create(['name' => 'admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        $ortu = OrangTua::create([
            "user_id" => $user->id,
            "status" => "ayah",
            "nik" => "234354645645",
            "pendidikan" => "sma/k",
            "pekerjaan" => "guru"
        ]);

        $user = User::create([
            "name" => "tyas",
            "email" => "tyas@gmail.com",
            "password" => bcrypt('rahasia123')
        ]);

        $ortu = OrangTua::create([
            "user_id" => $user->id,
            "status" => "ibu",
            "nik" => "2343546453434",
            "pendidikan" => "s1",
            "pekerjaan" => "wirasuasta"
        ]);

        $user = User::create([
            "name" => "rokhim",
            "email" => "rokhim@gmail.com",
            "password" => bcrypt('rahasia123')
        ]);

        $ortu = OrangTua::create([
            "user_id" => $user->id,
            "status" => "wali",
            "nik" => "234354645222",
            "pendidikan" => "sma/k",
            "pekerjaan" => "guru"
        ]);
    }
}
