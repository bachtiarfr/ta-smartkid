<?php

namespace App\Http\Controllers;

use App\Models\Asuransi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AsuransiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asuransi = Asuransi::all();

        return view('admin.asuransi.index',compact('asuransi'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asuransi = Asuransi::all();
        
        return view('admin.asuransi.create' , compact('asuransi') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsuransiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $asuransi = Asuransi::create([
            "nama" => $request->nama,
            "nilai" => $request->nilai
        ]);

        return redirect()->route('asuransi.index')
                        ->with('success','berhasil simpan data asuransi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function show(Asuransi $asuransi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function edit(Asuransi $asuransi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAsuransiRequest  $request
     * @param  \App\Models\Asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $asuransi = Asuransi::find($id);

        $asuransi->nama = $request->nama;
        $asuransi->nilai = $request->nilai;
        $asuransi->save();

        return redirect()->route('asuransi.index')
                        ->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asuransi $asuransi)
    {
        //
    }

    public function hapusasuransi( $id )
    {
        $asuransi = Asuransi::find( $id );
        $asuransi->delete();

        return redirect()->route('asuransi.index')
                        ->with('success','data berhasil dihapus');
    }

    public function ubahasuransi( $id )
    {
        $asuransi = Asuransi::where('id' , '=' , $id)->first();

        return view('admin.asuransi.edit' , compact('asuransi') );
    }
}
