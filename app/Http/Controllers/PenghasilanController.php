<?php

namespace App\Http\Controllers;

use App\Models\Penghasilan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PenghasilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penghasilan = Penghasilan::all();

        return view('admin.penghasilan.index',compact('penghasilan'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penghasilan = Penghasilan::all();
        
        return view('admin.penghasilan.create' , compact('penghasilan') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenghasilanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $penghasilan = Penghasilan::create([
            "penghasilan" => $request->penghasilan,
            "bobot" => $request->bobot
        ]);

        return redirect()->route('penghasilan.index')
                        ->with('success','berhasil simpan data penghasilan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penghasilan  $penghasilan
     * @return \Illuminate\Http\Response
     */
    public function show(Penghasilan $penghasilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penghasilan  $penghasilan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penghasilan $penghasilan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenghasilanRequest  $request
     * @param  \App\Models\Penghasilan  $penghasilan
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $penghasilan = Penghasilan::find($id);

        $penghasilan->penghasilan = $request->penghasilan;
        $penghasilan->bobot = $request->bobot;
        $penghasilan->save();

        return redirect()->route('penghasilan.index')
                        ->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penghasilan  $penghasilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penghasilan $penghasilan)
    {
        //
    }

    public function hapuspenghasilan( $id )
    {
        $penghasilan = Penghasilan::find( $id );
        $penghasilan->delete();

        return redirect()->route('penghasilan.index')
                        ->with('success','data berhasil dihapus');
    }

    public function ubahpenghasilan( $id )
    {
        $penghasilan = Penghasilan::where('id' , '=' , $id)->first();

        return view('admin.penghasilan.edit' , compact('penghasilan') );
    }
}
