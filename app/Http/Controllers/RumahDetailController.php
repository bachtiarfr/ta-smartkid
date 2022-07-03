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
                ->orderBy('rmh.keterangan' , 'asc')
                ->get();

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
    public function show(RumahDetail $rumahDetail)
    {
        //
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
    public function destroy(RumahDetail $rumahDetail)
    {
        //
    }
}
