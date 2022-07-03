<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\JenisBeasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = DB::table('periodes AS p')
            ->join('jenis_beasiswas AS b' , 'p.beasiswa_id' , '=' , 'b.id')
            ->select('p.id' , 'b.nama_beasiswa' , 'p.semester' , 'p.tahun' , 'p.status')
            ->paginate(10);

            return view('admin.periode.index',compact('periode'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beasiswa = JenisBeasiswa::all();
        
        return view('admin.periode.create' , compact('beasiswa') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePeriodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $periode = Periode::create([
            "user_id" => Auth::id(),
            "beasiswa_id" => $request->beasiswa_id,
            "semester" => $request->semester,
            "tahun" => $request->tahun,
            "status" => $request->status
        ]);

        return redirect()->route('periode.index')
                        ->with('success','berhasil simpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeriodeRequest  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $periode = Periode::find($id);

        $periode->user_id = Auth::id();
        $periode->beasiswa_id = $request->beasiswa_id;
        $periode->semester = $request->semester;
        $periode->tahun = $request->tahun;
        $periode->status = $request->status;
        $periode->save();

        return redirect()->route('periode.index')
                        ->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        //
    }

    public function hapusperiode( $id )
    {
        $periode = Periode::find($id);
        $periode->delete();

        return redirect()->route('periode.index')
                        ->with('success','data berhasil dihapus');
    }

    public function ubahperiode ( $id )
    {
        $periode = Periode::where('id' , '=' , $id)->first();
        $beasiswa = JenisBeasiswa::all();
        $user = User::all();

        return view('admin.periode.edit' , compact('periode' , 'user' , 'beasiswa') );
    }

}
