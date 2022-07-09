<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Siswa;
use App\Models\Penghasilan;
use App\Models\TanggunganAnak;
use App\Models\Asuransi;
use App\Models\Rumah;
use App\Models\RumahDetail;
use App\Models\Assets;
use App\Models\Ternak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        // $data = DB::table('penilaians AS pn')
        //         ->join('penilaian_details AS pnd' , 'pn.id' , '=' , 'pnd.penilaian_id')
        //         ->select('pn.id' , 'pn.c1' , 'pn.c2' , 'pn.c3' , 'pn.c4' , 'pn.c5' , 'pn.c6')
        //         ->get();

        $siswa = DB::table('siswas AS sw')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->select( 'us.nama_depan', 'us.nama_belakang')
                ->get();

        $data = DB::table('penilaians AS pn')
                ->select('pn.id' , 'pn.c1' , 'pn.c2' , 'pn.c3' , 'pn.c4' , 'pn.c5')
                ->get();


        // datatable
        if ($request->ajax()) {

            // $data = Penilaian::all();

            return Datatables::of( $data )
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="#" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.penilaian.index');
        // return response()->json($data);
    }

    public function hitungpenilaian (  )
    {

        $penilaian = DB::table('penilaians AS pnl')
                ->join('users AS us' , 'pnl.siswa_id' , '=' , 'us.id')
                ->select('pnl.id' , 'us.nama_depan', 'us.nama_belakang' , 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
                ->get();

        $maxValue = [
            "maxC1" => floatval(DB::table("penilaians")->max("c1")),
            "maxC2" => floatval(DB::table("penilaians")->max("c2")),
            "maxC3" => floatval(DB::table("penilaians")->max("c3")),
            "maxC4" => floatval(DB::table("penilaians")->max("c4")),
            "maxC5" => floatval(DB::table("penilaians")->max("c5")),
        ];

        return view('admin.penilaian.hitung' , compact('penilaian', 'maxValue'));
    }

    public function getpenilaian(  )
    {
        $penilaian = DB::table('penilaians AS pnl')
                ->join('users AS us' , 'pnl.siswa_id' , '=' , 'us.id')
                ->select('pnl.id' , 'us.nama_depan', 'us.nama_belakang' , 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
                ->get();

        return response()->json($penilaian);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('admin.penilaian.create' , compact('ternak' , 'assets' , 'rumah' , 'siswa' , 'penghasilan' , 'tanggungan' , 'asuransi'));
        
        // return response()->json($rumah);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenilaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataPenilaian = Penilaian::create([
            "siswa_id" => $request->siswa_id,
            "penghasilan_id" => $request->penghasilan_id,
            "tanggungan_id" => $request->tanggungan_id,
            "asuransi_id" => $request->asuransi_id,
            "c1" => $request->c1,
            "c2" => $request->c2,
            "c3" => $request->c3,
            "c4" => $request->c4,
            "c5" => $request->c5
        ]); 

        PenilaianDetail::create([
            "penilaian_id" => $dataPenilaian->id,
            "rumah_id" => $request->rumah_id,
            "assets_id" => $request->asset_id,
            "value_assets" => $request->asset_value,
            "value_rumah" => $request->rumah_data,
        ]);

        return response()->json([
            "message" =>  "data berhasil disimpan", 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianRequest  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
