<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Siswa_Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil data dari model
        $sw = Siswa::join('users as us' , 'siswas.user_id' , '=' , 'us.id')
            ->select('siswas.id' , 'us.nama_depan', 'us.nama_belakang' , 'siswas.nisn' , 'siswas.jk' , 'siswas.berkas_prestasi' , DB::raw("CONCAT(siswas.kelas , '-' , siswas.jurusan) AS kelas"))
            ->get();

        $sp = Siswa_Prestasi::all();


        //query menampilkan data prestasi pada 1 field
        $siswa = $sw->map( function($row) use ($sp) {
            $prestasi = $sp->where( 'siswa_id' , $row->id )->where( 'prestasi', '!=', null )->pluck( 'prestasi' );
            return collect($row)->put('prestasi' , $prestasi );
        });

        return view('admin.siswa.index',compact('siswa'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // return response()->json($siswa);
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ortu = DB::table('orang_tuas AS or')
        ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
        ->select('or.id' , 'us.nama_depan' )
        ->get();

        return view('admin.siswa.create' , compact('ortu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $namaBerkas = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('berkas_prestasi')->getClientOriginalName();

        $request->berkas_prestasi->move(public_path('images') , $namaBerkas);

        // //1. simpan ke tabel user
        $user = User::create([
            "nama_depan" => $request->nama_depan,
            "nama_belakang" => $request->nama_belakang,
            "email" => Str::lower($request->nama_depan . "@gmail.com"),
            "password" => bcrypt("rahasia123")
        ]);

        // //2. simpan ke tabel siswa

        $siswa = Siswa::create([
            "user_id" => $user->id,
            "ortu_id" => $request->ortu_id,
            "nisn" => $request->nisn,
            "jk" => $request->jk,
            "jurusan" => $request->jurusan,
            "kelas" => $request->kelas,
            "berkas_prestasi" => $namaBerkas
        ]);

        // 3. simpan data prestasi sesuai clone ajax

        if ( count( $request->all() ) > 8 ) {
            $jumlah = count( $request->all() ) - 8 ;

            for ($i=0; $i < $jumlah - 1 ; $i++) { 
                if ( $i == 0 ) {
                    
                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi
                    ]);

                } elseif ( $i == 1 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi1
                    ]);

                } elseif ( $i == 2 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi2
                    ]);

                } elseif ( $i == 3 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi3
                    ]);

                } elseif ( $i == 4 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi4
                    ]);

                } elseif ( $i == 5 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi5
                    ]);

                } elseif ( $i == 6 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi6
                    ]);

                } elseif ( $i == 7 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi7
                    ]);

                } elseif ( $i == 8 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi8
                    ]);

                } elseif ( $i == 9 ) {

                    $sw_pres = Siswa_Prestasi::create([
                        "siswa_id" => $siswa->id,
                        "prestasi" => $request->prestasi9
                    ]);

                }
            }
        }

        return redirect()->route('siswa.index')
                        ->with('success' , 'berhasil simpan data siswa' );

        // return response()->json($request->all() );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        //ambil data dari model
        $sw = Siswa::join('users as us' , 'siswas.user_id' , '=' , 'us.id')
            ->where('siswas.id' , '=' , $id )
            ->select('siswas.id' , 'us.nama_depan', 'us.nama_belakang' , 'siswas.nisn' , 'siswas.jk' , 'siswas.berkas_prestasi' , 'siswas.kelas' , 'siswas.jurusan' )
            ->get();

        $sp = Siswa_Prestasi::all();


        //query menampilkan data prestasi pada 1 field
        $siswa = $sw->map( function($row) use ($sp) {
            $prestasi = $sp->where( 'siswa_id' , $row->id )->pluck( 'prestasi' );
            return collect($row)->put('prestasi' , $prestasi );
        });

        return view('admin.siswa.edit', compact('siswa'));
        // return response()->json( $siswa );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        dd($request);
        $berkas = $siswa->berkas_prestasi;

        // cek user apakah mengubah file?
        // jika tidak diubah menggunakan file lama
        if ( $request->hasFile('berkas_prestasi') ) {
            // hapus file lama
            unlink( public_path() . "/images/" . $berkas );
            // simpan file baru dan move ke folder
            $namaBerkas = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('berkas_prestasi')->getClientOriginalName();

            $request->berkas_prestasi->move(public_path('images') , $namaBerkas);

           
            // 1. simpan ke tabel user 
            $user = User::where('id' , '=' , $siswa->user_id)->first();
            $user->nama_depan = $request->nama_depan;
            $user->nama_belakang = $request->nama_belakang;
            $user->email = $request->nama_depan . "@gmail.com";
            $user->save();

            // 2. simpan ke tabel siswa
            $siswa->admin_id = Auth::id();
            $siswa->user_id = $user->id;
            $siswa->nisn = $request->nisn;
            $siswa->jk = $request->jk;
            $siswa->jurusan = $request->jurusan;
            $siswa->kelas = $request->kelas;
            $siswa->berkas_prestasi = $namaBerkas;
            $siswa->save();

            // 3. simpan ke tabel siswa_prestasi
            // hapus dulu isi tabel siswa prestasi berhasarkan siswa_id
            $sp = Siswa_Prestasi::where('siswa_id' , $siswa->id)->delete();

            if ( $request->cnt_text > 0 ) {
                $jumlah = $request->cnt_text ;
    
                for ($i=0; $i < $jumlah - 1 ; $i++) { 
                    if ( $i == 0 ) {
                        
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi
                        ]);
    
                    } elseif ( $i == 1 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi1
                        ]);
    
                    } elseif ( $i == 2 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi2
                        ]);
    
                    } elseif ( $i == 3 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi3
                        ]);
    
                    } elseif ( $i == 4 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi4
                        ]);
    
                    } elseif ( $i == 5 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi5
                        ]);
    
                    } elseif ( $i == 6 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi6
                        ]);
    
                    } elseif ( $i == 7 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi7
                        ]);
    
                    } elseif ( $i == 8 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi8
                        ]);
    
                    } elseif ( $i == 9 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi9
                        ]);
    
                    }
                }
            }

        } else {
            // hapus file lama
            // 1. simpan ke tabel user 
            $user = User::where('id' , '=' , $siswa->user_id)->first();
            $user->nama_depan = $request->nama_depan;
            $user->nama_belakang = $request->nama_belakang;
            $user->email = $request->nama_depan . "@gmail.com";
            $user->save();

            // 2. simpan ke tabel siswa
            // $siswa->admin_id = Auth::id();
            $siswa->user_id = $user->id;
            $siswa->nisn = $request->nisn;
            $siswa->jk = $request->jk;
            $siswa->jurusan = $request->jurusan;
            $siswa->kelas = $request->kelas;
            $siswa->save();

            // 3. simpan ke tabel siswa_prestasi
            // hapus dulu isi tabel siswa prestasi berhasarkan siswa_id
            $sp = Siswa_Prestasi::where('siswa_id' , $siswa->id)->delete();

            if ( $request->cnt_text > 0 ) {
                $jumlah = $request->cnt_text ;
                for ($i=0; $i < $jumlah ; $i++) { 
                    if ( $i == 0 ) {                        
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi
                        ]);
    
                    } elseif ( $i == 1 ) {
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi1
                        ]);
    
                    } elseif ( $i == 2 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi2
                        ]);
    
                    } elseif ( $i == 3 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi3
                        ]);
    
                    } elseif ( $i == 4 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi4
                        ]);
    
                    } elseif ( $i == 5 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi5
                        ]);
    
                    } elseif ( $i == 6 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi6
                        ]);
    
                    } elseif ( $i == 7 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi7
                        ]);
    
                    } elseif ( $i == 8 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi8
                        ]);
    
                    } elseif ( $i == 9 ) {
    
                        $sw_pres = Siswa_Prestasi::create([
                            "siswa_id" => $siswa->id,
                            "prestasi" => $request->prestasi9
                        ]);
    
                    }
                }
            }
        }

        return redirect()->route('siswa.index')->with('success' , 'berhasil simpan data siswa' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }

    public function hapussiswa( $id )
    {
        // 1. hapus tabel siswa dan prestasi
        $siswa = Siswa::find( $id );

        // 2. hapus tabel user
        $user = User::where( 'id' , $siswa->user_id )->delete();
        
        $siswa->delete();

        return redirect()->route('siswa.index')
                        ->with('success','berhasil hapus data siswa');
    }


}
