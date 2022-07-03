<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftar = DB::table('pendaftars AS pn')
                ->join('siswas AS s' , 'pn.siswa_id' , '=' ,'s.id')
                ->join('users AS u' , 's.user_id' , '=' , 'u.id' )
                ->join('orang_tuas AS o' , 'pn.ortu_id' , '=' , 'o.id')
                ->join('users AS uu' , 'o.user_id' , '=' , 'uu.id')               
                ->join('periodes AS p' , 'pn.periode_id' , '=' , 'p.id')
                ->join('jenis_beasiswas AS j' , 'p.beasiswa_id' , '=' , 'j.id')
                ->select('pn.id' , 'u.name' , 's.nisn' , 's.jk' , 's.kelas' , 's.jurusan' , 'uu.name' , 'o.penghasilan' , 'j.nama_beasiswa' , 'p.semester' , 'p.tahun' )
                ->paginate(10);
                
        // $siswa = DB::table('siswas AS s')
        //         ->join('users AS us' , 's.user_id' , '=' , 'us.id')
        //         ->select('s.id' , 'us.name' , 's.nisn' , 's.jk' , 's.kelas' , 's.jurusan')
        //         ->paginate(10);

        // $ortu = DB::table('orang_tuas AS or')
        //         ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
        //         ->select('or.id' , 'us.name' , 'or.penghasilan')
        //         ->paginate(10);

        // $periode = DB::table('periodes AS p')
        //         ->join('jenis_beasiswas AS j' , 'p.beasiswa_id' , '=' , 'j.id')
        //         ->select('p.id' , 'j.nama_beasiswa' , 'p.semester' , 'p.tahun')
        //         ->paginate(10);

        return view('admin.pendaftar.index',compact('pendaftar' ))
                ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = DB::table('periodes AS p')
                ->join('jenis_beasiswas AS j' , 'p.beasiswa_id' , '=' , 'j.id')
                ->select('p.id' , 'j.nama_beasiswa')
                ->get();

        $ortu = DB::table('orang_tuas AS or')
                ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
                ->select('or.id' , 'us.name')
                ->get();

        $siswa = DB::table('siswas AS s')
                ->join('users AS us' , 's.user_id' , '=' , 'us.id')
                ->select('s.id' , 'us.name')
                ->get();

        return view('admin.pendaftar.create' , compact('periode' , 'ortu' , 'siswa') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePendaftarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        $pendaftar = Pendaftar::create([
            "user_id" => Auth::id(),
            "siswa_id" => $request->siswa_id,
            "ortu_id" => $request->ortu_id,
            "periode_id" => $request->periode_id
        ]);

        return redirect()->route('pendaftar.index')
                        ->with('success','berhasil simpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePendaftarRequest  $request
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }

    public function hapuspendaftar( $id )
    {
        $pendaftar = Pendaftar::find($id);
        $pendaftar->delete();

        return redirect()->route('pendaftar.index')
                        ->with('success','data berhasil dihapus');
    }
}
