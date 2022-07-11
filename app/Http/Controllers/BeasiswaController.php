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
