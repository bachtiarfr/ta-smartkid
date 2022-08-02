<?php

namespace App\Http\Controllers;

use App\Models\RumahDetail;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class RumahDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.rumah.index');
    }

    public function getrumah()
    {
        $data = DB::table('rumah_details AS rmd')
                ->join('rumahs AS rmh' , 'rmd.rumah_id' , '=' , 'rmh.id')
                ->select('rmd.id' , 'rmd.rumah_id' , 'rmh.keterangan' , 'rmd.key' , 'rmd.value')
                ->groupBy('rmd.id')
                ->groupBy('rmd.rumah_id')
                ->groupBy('rmh.keterangan')
                ->groupBy('rmd.key')
                ->groupBy('rmd.value')
                ->orderBy('rmd.rumah_id' , 'asc')
                ->orderBy('rmh.keterangan' , 'asc')
                ->get();
        // dd($data);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.rumah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRumahDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRumahDetailRequest $request)
    {
        //
    }

    public function simpanrumah( Request $request)
    {
        $rumah = Rumah::create([
            "keterangan" => $request->keterangan
        ]);

        return response()->json( $rumah->id );
    }

    public function simpanrumahdetail( Request $request , $id )
    {
        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $ternak_det = RumahDetail::create([
                "rumah_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( $request['isi_det'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RumahDetail  $rumahDetail
     * @return \Illuminate\Http\Response
     */

    public function showedit ( $id )
    {
        $rumahDetail = DB::table('rumah_details AS asd')
                ->join('rumahs AS as' , 'asd.rumah_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('asd.id' , 'asd.rumah_id' , 'as.keterangan' , 'asd.key' , 'asd.value')
                ->groupBy('asd.id')
                ->groupBy('asd.rumah_id')
                ->groupBy('as.keterangan')
                ->groupBy('asd.key')
                ->groupBy('asd.value')
                ->orderBy('as.keterangan' , 'asc')
                ->get();
        
        $rumah_id = DB::table('rumahs AS as')
                ->join('rumah_details AS asd' , 'asd.rumah_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('asd.rumah_id')
                ->first();
        
        $rumah = DB::table('rumahs AS as')
                ->join('rumah_details AS asd' , 'asd.rumah_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('as.keterangan')
                ->first();

        return view ('admin.rumah.edit' , compact( 'rumahDetail' , 'rumah' , 'rumah_id') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RumahDetail  $rumahDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(RumahDetail $rumahDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRumahDetailRequest  $request
     * @param  \App\Models\RumahDetail  $rumahDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRumahDetailRequest $request, RumahDetail $rumahDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RumahDetail  $rumahDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(RumahDetail $rumahDetail, $id)
    {
        DB::table("rumah")->where("id", $id)->delete();
        DB::table("rumah_detail")->where("rumah_id", $id)->delete();
    }
    
    public function ubahrumah( Request $request, $id)
    {
        $rumah = Rumah::find( $id );
        $rumah->keterangan = $request->rumah;
        $rumah->save();

        return response()->json( $rumah->id );
    }

    public function ubahrumahdetail( Request $request , $id )
    {
        $rumah_detail = RumahDetail::where('rumah_id' , '=' , $id )->delete();

        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $assets_det = RumahDetail::create([
                "rumah_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( "berhasil disimpan" );
    }
}
