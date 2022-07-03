<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ternak;
use App\Models\TernakDetail;

class TernakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. sapi
        $ternak = Ternak::create([
            'nama' => 'Sapi'
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => 'Tidak memiliki',
            'value' => 100
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '1 ekor',
            'value' => 80
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '2 ekor',
            'value' => 60
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '3 - 5 ekor',
            'value' => 40
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '5 - 10 ekor',
            'value' => 20
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '> 10 ekor',
            'value' => 0
        ]);

        // 2. kerbau
        $ternak = Ternak::create([
            'nama' => 'Kerbau'
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => 'Tidak memiliki',
            'value' => 100
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '1 ekor',
            'value' => 80
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '2 ekor',
            'value' => 60
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '3 - 5 ekor',
            'value' => 40
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '5 - 10 ekor',
            'value' => 20
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '> 10 ekor',
            'value' => 0
        ]);

        // 3. kuda
        $ternak = Ternak::create([
            'nama' => 'Kuda'
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => 'Tidak memiliki',
            'value' => 100
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '1 ekor',
            'value' => 80
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '2 ekor',
            'value' => 60
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '3 - 5 ekor',
            'value' => 40
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '5 - 10 ekor',
            'value' => 20
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '> 10 ekor',
            'value' => 0
        ]);

        // 4. kambing
        $ternak = Ternak::create([
            'nama' => 'Kambing'
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => 'Tidak memiliki',
            'value' => 100
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '1 ekor',
            'value' => 80
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '2 ekor',
            'value' => 60
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '3 - 5 ekor',
            'value' => 40
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '5 - 10 ekor',
            'value' => 20
        ]);

        $ternak_detail = TernakDetail::create([
            'ternak_id' => $ternak->id,
            'key' => '> 10 ekor',
            'value' => 0
        ]);
    }
}
