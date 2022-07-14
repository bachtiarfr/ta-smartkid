<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\Assets;
use App\Models\Ternak;
use App\Models\Penghasilan;
use App\Models\TanggunganAnak;
use App\Models\Asuransi;

use DB;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // query builder
        $siswa = DB::table('siswas AS sw')
            ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
            ->select('sw.user_id' , 'us.nama_depan', 'us.nama_belakang')
            ->groupBy('sw.id')
            ->groupBy('us.nama_depan')
            ->groupBy('us.nama_belakang')
            ->orderBy('us.nama_depan')
            ->get();

        // elequent with => menciptakan nested array
        $rumah = Rumah::with('rumahdetail')->get();
        $assets = Assets::with('assetsdetail')->get();
        $ternak = Ternak::with('ternakdetail')->get();
        // query builder
        $penghasilan = Penghasilan::all();
        $tanggungan = TanggunganAnak::all();
        $asuransi = Asuransi::all();

        return view('daftar-beasiswa', compact('ternak' , 'assets' , 'rumah' , 'siswa' , 'penghasilan' , 'tanggungan' , 'asuransi'));
    }


    public function hasilPengumuman() 
    {

        $penilaian = DB::table('penilaians AS pnl')
                ->join('users AS us' , 'pnl.siswa_id' , '=' , 'us.id')
                ->select('pnl.id' , 'us.nama_depan', 'us.nama_belakang' , 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
                ->get();

        // cari max value dari setiap kriteria

        $nValue = [
            "minC1" => floatval(DB::table("penilaians")->min("c1")),
            "minC2" => floatval(DB::table("penilaians")->min("c2")),
            "minC3" => floatval(DB::table("penilaians")->min("c3")),
            "maxC4" => floatval(DB::table("penilaians")->max("c4")),
            "minC5" => floatval(DB::table("penilaians")->min("c5")),
        ];

        // proses normalisasi
        foreach ($penilaian as $dataNilai) {
            if ($nValue["minC1"] == 0) {
                $dataNilai->c1 = 1;
            } 
            
            if ($nValue["minC2"] == 0) {
                $dataNilai->c2 = 1;
            } 
    
            if ($nValue["minC3"] == 0) {
                $dataNilai->c3 = 1;
            } 
            
            if ($nValue["minC5"] == 0) {
                $dataNilai->c5 = 1;
            } 

            $dataNormalisasi[] = [
                "nama" => $dataNilai->nama_depan . ' ' . $dataNilai->nama_belakang,
                "r1" => round($nValue["minC1"] / $dataNilai->c1, 2), 
                "r2" => round($nValue["minC2"] / $dataNilai->c2, 2), 
                "r3" => round($nValue["minC3"] / $dataNilai->c3, 2), 
                "r4" => round($dataNilai->c4 / $nValue["maxC4"], 2), 
                "r5" => round($nValue["minC5"] / $dataNilai->c5, 2)
            ];
        }

        // nilai normalisasi dikali dengan bobot
        foreach ($dataNormalisasi as $key => $v) {
            $dataPerangkingan[] = [
                "nama" => $v["nama"],
                "v1" => round(($v["r1"]*0.25), 2),
                "v2" => round(($v["r2"]*0.20), 2),
                "v3" => round(($v["r3"]*0.15), 2),
                "v4" => round(($v["r4"]*0.15), 2),
                "v5" => round(($v["r5"]*0.30), 2),
                "w" => (round(($v["r1"]*0.25), 2)) + (round(($v["r2"]*0.20), 2)) + (round(($v["r3"]*0.15), 2)) + (round(($v["r4"]*0.15), 2)) + (round(($v["r5"]*0.30), 2))
            ];
        }


        return view('hasil-pengumuman', compact('dataPerangkingan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
