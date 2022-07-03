<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penghasilan;

class PenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penghasilan = Penghasilan::create([
            'penghasilan' => '< 1.000.000',
            'bobot' => 100
        ]);

        $penghasilan = Penghasilan::create([
            'penghasilan' => '1.000.000 - 3.000.000',
            'bobot' => 75
        ]);

        $penghasilan = Penghasilan::create([
            'penghasilan' => '> 3.000.000 - 6.000.000',
            'bobot' => 40
        ]);

        $penghasilan = Penghasilan::create([
            'penghasilan' => '> 10.000.00',
            'bobot' => 0
        ]);
    }
}
