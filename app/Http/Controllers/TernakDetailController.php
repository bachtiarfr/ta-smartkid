<?php

namespace App\Http\Controllers;

use App\Models\TernakDetail;
use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TernakDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
    {
        // if ($request->ajax()) {
            
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
     
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        return view('admin.ternak.index');

    }

    public function getternak( )
    {
        $data = DB::table('ternak_details AS trd')
                ->join('ternaks AS tr' , 'trd.ternak_id' , '=' , 'tr.id')
                ->select('trd.id' , 'trd.ternak_id' , 'tr.nama' , 'trd.key' , 'trd.value')
                ->groupBy('trd.id')
                ->groupBy('trd.ternak_id')
                ->groupBy('tr.nama')
                ->groupBy('trd.key')
                ->groupBy('trd.value')
                ->orderBy('tr.nama' , 'asc')
                ->get();

        return response()->json( $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.ternak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTernakDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        //1. simpan ke tabel ternak


        //2. simpan ke tabel ternak detail
    }

    public function simpanternak( Request $request )
    {
        //1. simpan ke tabel ternak
        $ternak = Ternak::create([
            "nama" => $request->nama
        ]);

        return response()->json( $ternak->id );
    }

    public function simpanternakdetail( Request $request , $id )
    {
        //2. simpan ke tabel ternak detail
        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $ternak_det = TernakDetail::create([
                "ternak_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( $request['isi_det'] );

        // return response()->json( $request['isi_det'][0]['value'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TernakDetail  $ternakDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TernakDetail $ternakDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TernakDetail  $ternakDetail
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $data = DB::table('ternaks AS tr')
                ->join('ternak_details AS trd' , 'trd.ternak_id' , '=' , 'tr.id')
                ->where('tr.id' , '=' , $id)
                ->select('trd.id' , 'trd.ternak_id' , 'tr.nama' , 'trd.key' , 'trd.value')
                ->groupBy('trd.id')
                ->groupBy('trd.ternak_id')
                ->groupBy('tr.nama')
                ->groupBy('trd.key')
                ->groupBy('trd.value')
                ->orderBy('tr.nama' , 'asc')
                ->get();
        
        return response()->json($data);
    }

    public function showedit ( $id )
    {
        $data = DB::table('ternaks AS tr')
                ->join('ternak_details AS trd' , 'trd.ternak_id' , '=' , 'tr.id')
                ->where('tr.id' , '=' , $id)
                ->select('trd.id' , 'trd.ternak_id' , 'tr.nama' , 'trd.key' , 'trd.value')
                ->groupBy('trd.id')
                ->groupBy('trd.ternak_id')
                ->groupBy('tr.nama')
                ->groupBy('trd.key')
                ->groupBy('trd.value')
                ->orderBy('tr.nama' , 'asc')
                ->get();
        
        $ternak_id = DB::table('ternaks AS tr')
                ->join('ternak_details AS trd' , 'trd.ternak_id' , '=' , 'tr.id')
                ->where('tr.id' , '=' , $id)
                ->select('trd.ternak_id')
                ->first();
        
        $nama = DB::table('ternaks AS tr')
                ->join('ternak_details AS trd' , 'trd.ternak_id' , '=' , 'tr.id')
                ->where('tr.id' , '=' , $id)
                ->select('tr.nama')
                ->first();

        return view ('admin.ternak.edit' , compact( 'data' , 'nama' , 'ternak_id') );
    }

    public function ubahternak( Request $request , $id )
    {
        $ternak = Ternak::find( $id );
        $ternak->nama = $request->nama;
        $ternak->save();

        return response()->json( $ternak->id );
    }

    public function ubahternakdetail( Request $request , $id )
    {
        $ternak_detail = TernakDetail::where('ternak_id' , '=' , $id )->delete();

        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $ternak_det = TernakDetail::create([
                "ternak_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( "berhasil disimpan" );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTernakDetailRequest  $request
     * @param  \App\Models\TernakDetail  $ternakDetail
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, TernakDetail $ternakDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TernakDetail  $ternakDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TernakDetail $ternakDetail)
    {
        //
    }
}
