<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            OrangTuaSeeder::class,
            PermissionTableSeeder::class,
            AssetsSeeder::class,
            TernakSeeder::class,
            RumahSeeder::class,
            AsuransiSeeder::class,
            TanggunganSeeder::class,
            PenghasilanSeeder::class,
        ]);
    }
}
