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
                ->select( 'us.name')
                ->get();

        // $data = DB::table('penilaian_details AS pnd')
        //         ->join('penilaians AS pn' , 'pnd.penilaian_id ' , '=' , 'pn.id')
        //         ->select('pn.id' , 'pn.c1' , 'pn.c2' , 'pn.c3' , 'pn.c4' , 'pn.c5' , 'pn.c6')
        //         ->get();


        // datatable
        if ($request->ajax()) {

            $data = Penilaian::all();

            return Datatables::of($data , $siswa)
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
                ->select('sw.id' , 'us.name')
                ->groupBy('sw.id')
                ->groupBy('us.name')
                ->orderBy('us.name')
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

        var_dump($request);
        $penilaian = Penilaian::create([
            "siswa_id" => $request->siswa_id,
            "penghasilan_id" => $request->penghasilan_id,
            "tanggungan_id" => $request->tanggungan_id,
            "asuransi_id" => $request->asuransi_id,
            "c1" => $request->c1,
            "c2" => $request->c2,
            "c3" => $request->c3,
            "c4" => $request->c4,
            "c5" => $request->c5,
            "c6" => $request->c6
        ]);

        // $p_detail = PenilaianDetail::create([
        //     "penilaian_id" => $penilaian->id,
        //     "rumah_id" => $request->rumah_id,
        //     "value_rumah" => $request->rumah_data,
        // ]);

        return response()->json( "data berhasil disimpan" );
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
