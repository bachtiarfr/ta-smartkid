<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asuransi;

class AsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asuransi = Asuransi::create([
            'nama' => 'Asuransi Kesehatan Swasta',
            'nilai' => 0
        ]);

        $asuransi = Asuransi::create([
            'nama' => 'BPJS Kelas 3',
            'nilai' => 20
        ]);

        $asuransi = Asuransi::create([
            'nama' => 'BPJS Kelas 2',
            'nilai' => 50
        ]);

        $asuransi = Asuransi::create([
            'nama' => 'BPJS Kelas 1',
            'nilai' => 70
        ]);
        
    }
}
