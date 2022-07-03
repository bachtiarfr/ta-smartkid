<?php

namespace App\Http\Controllers;

use App\Models\TanggunganAnak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TanggunganAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggungan = TanggunganAnak::all();

        return view('admin.tanggungan.index',compact('tanggungan'))
                ->with('i', (request()->input('page', 1) - 1) * 5);

        // return response()->json($tanggungan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tanggungan = TanggunganAnak::all();
        
        return view('admin.tanggungan.create' , compact('tanggungan') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTanggunganAnakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $tanggungan = TanggunganAnak::create([
            "jumlah" => $request->jumlah,
            "nilai" => $request->nilai
        ]);

        return redirect()->route('tanggungan.index')
                        ->with('success','berhasil simpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TanggunganAnak  $tanggunganAnak
     * @return \Illuminate\Http\Response
     */
    public function show(TanggunganAnak $tanggunganAnak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TanggunganAnak  $tanggunganAnak
     * @return \Illuminate\Http\Response
     */
    public function edit(TanggunganAnak $tanggunganAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTanggunganAnakRequest  $request
     * @param  \App\Models\TanggunganAnak  $tanggunganAnak
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $tanggungan = TanggunganAnak::find($id);

        $tanggungan->jumlah = $request->jumlah;
        $tanggungan->nilai = $request->nilai;
        $tanggungan->save();

        return redirect()->route('tanggungan.index')
                        ->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TanggunganAnak  $tanggunganAnak
     * @return \Illuminate\Http\Response
     */
    public function destroy(TanggunganAnak $tanggunganAnak)
    {
        //
    }

    public function hapustanggungan( $id )
    {
        $tanggungan = TanggunganAnak::find( $id );
        $tanggungan->delete();

        return redirect()->route('tanggungan.index')
                        ->with('success','data berhasil dihapus');
    }

    public function ubahtanggungan( $id )
    {
        $tanggungan = TanggunganAnak::where('id' , '=' , $id)->first();

        return view('admin.tanggungan.edit' , compact('tanggungan') );
    }
}
