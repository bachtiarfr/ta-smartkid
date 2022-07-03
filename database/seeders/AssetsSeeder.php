<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assets;
use App\Models\AssetsDetail;

class AssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asset = Assets::create([
            'nama' => 'Kendaraan Roda 4 atau lebih'
        ]);

        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Memiliki',
            'value' => '0'
        ]);
        
        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Tidak meiliki',
            'value' => '100'
        ]);

        $asset = Assets::create([
            'nama' => 'Kendaraan Roda 2'
        ]);

        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Tidak memiliki',
            'value' => '100'
        ]);
        
        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Memiliki 1 - 2',
            'value' => '80'
        ]);

        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Memiliki 3 - 5',
            'value' => '30'
        ]);
        
        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Memiliki > 5',
            'value' => '0'
        ]);

        $asset = Assets::create([
            'nama' => 'Bidang Tanah / Sawah'
        ]);

        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Memiliki 2 - 3 bidang tanah / sawah',
            'value' => '0'
        ]);
        
        $asset_detail = AssetsDetail::create([
            'assets_id' => $asset->id,
            'key' => 'Tidak memiliki bidang tanah / sawah',
            'value' => '100'
        ]);
    }
}
