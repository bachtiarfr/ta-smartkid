<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TanggunganAnak;


class TanggunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tanggungan = TanggunganAnak::create([
            'jumlah' => '1 Anak',
            'nilai' => 50
        ]);

        $tanggungan = TanggunganAnak::create([
            'jumlah' => '2 - 4 Anak',
            'nilai' => 75
        ]);

        $tanggungan = TanggunganAnak::create([
            'jumlah' => '> 4 Anak',
            'nilai' => 100
        ]);
    }
}
