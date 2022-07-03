<?php

namespace Database\Seeders;
use App\Models\Rumah;
use App\Models\RumahDetail;

use Illuminate\Database\Seeder;

class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. status rumah / kepemilikan

        $rumah = Rumah::create([
            'keterangan' => 'Status Kepemilikan'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Kontrak/sewa',
            'value' => '100'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Milik pribadi',
            'value' => '25'
        ]);

        //2. luas bangunan
        $rumah = Rumah::create([
            'keterangan' => 'Luas Bangunan'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => '< 50 m2',
            'value' => '100'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => '50 - 100 m2',
            'value' => '75'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => '100 - 400 m2',
            'value' => '50'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => '> 400 m2',
            'value' => '0'
        ]);

        //3. jenis atau kondisi bangunan
        $rumah = Rumah::create([
            'keterangan' => 'Jenis / Kondisi Bangunan Dinding'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Tembok Kualitas Tinggi',
            'value' => '40'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Tembok Kualitas Rendah',
            'value' => '65'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Kayu Kualitas Tinggi',
            'value' => '0'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Kayu Kualitas Rendah',
            'value' => '80'
        ]);

        $rumah_detail = RumahDetail::create([
            'rumah_id' => $rumah->id,
            'key' => 'Bambu',
            'value' => '100'
        ]);
    }
}
