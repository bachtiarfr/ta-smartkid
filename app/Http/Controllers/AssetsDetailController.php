<?php

namespace App\Http\Controllers;

use App\Models\AssetsDetail;
use App\Models\Assets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AssetsDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.poperti.index');
    }

    public function getassets( )
    {
        $data = DB::table('assets_details AS asd')
                ->join('assets AS as' , 'asd.assets_id' , '=' , 'as.id')
                ->select('asd.id' , 'asd.assets_id' , 'as.nama' , 'asd.key' , 'asd.value')
                ->groupBy('asd.id')
                ->groupBy('asd.assets_id')
                ->groupBy('as.nama')
                ->groupBy('asd.key')
                ->groupBy('asd.value')
                ->orderBy('as.nama' , 'asc')
                ->get();

        return response()->json( $data );
    }

    public function simpanasstes( Request $request )
    {
        // return $request;
        //1. simpan ke tabel assets
        $assets = Assets::create([
            "nama" => $request->nama
        ]);

        return response()->json( $assets->id );
    }

    public function simpanassetsdetail( Request $request , $id )
    {
        // return $id;
        //2. simpan ke tabel ternak detail
        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $ternak_det = AssetsDetail::create([
                "assets_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( $request['isi_det'] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.poperti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssetsDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetsDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetsDetail  $assetsDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AssetsDetail $assetsDetail)
    {
        //
    }

    public function showedit ( $id )
    {
        $assets = DB::table('assets_details AS asd')
                ->join('assets AS as' , 'asd.assets_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('asd.id' , 'asd.assets_id' , 'as.nama' , 'asd.key' , 'asd.value')
                ->groupBy('asd.id')
                ->groupBy('asd.assets_id')
                ->groupBy('as.nama')
                ->groupBy('asd.key')
                ->groupBy('asd.value')
                ->orderBy('as.nama' , 'asc')
                ->get();
        
        $assets_id = DB::table('assets AS as')
                ->join('assets_details AS asd' , 'asd.assets_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('asd.assets_id')
                ->first();
        
        $nama = DB::table('assets AS as')
                ->join('assets_details AS asd' , 'asd.assets_id' , '=' , 'as.id')
                ->where('as.id' , '=' , $id)
                ->select('as.nama')
                ->first();

        return view ('admin.poperti.edit' , compact( 'assets' , 'nama' , 'assets_id') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetsDetail  $assetsDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetsDetail $assetsDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetsDetailRequest  $request
     * @param  \App\Models\AssetsDetail  $assetsDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetsDetailRequest $request, AssetsDetail $assetsDetail)
    {
        //
    }

    public function ubahassets( Request $request , $id )
    {
        $assets = Assets::find( $id );
        $assets->nama = $request->nama;
        $assets->save();

        return response()->json( $assets->id );
    }

    public function ubahassetsdetail( Request $request , $id )
    {
        $assets_detail = AssetsDetail::where('assets_id' , '=' , $id )->delete();

        for ($i=0; $i < count( $request['isi_det'] ) ; $i++) { 
            $assets_det = AssetsDetail::create([
                "assets_id" => $id ,
                "key" => $request['isi_det'][$i]['key'] ,
                "value" => $request['isi_det'][$i]['value'] 
            ]);
        }

        return response()->json( "berhasil disimpan" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetsDetail  $assetsDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetsDetail $assetsDetail, $id)
    {
        DB::table("assets")->where("id", $id)->delete();
        DB::table("assets_details")->where("assets_id", $id)->delete();
    }
}
