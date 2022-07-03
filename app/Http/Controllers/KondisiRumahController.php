<?php

namespace App\Http\Controllers;

use App\Models\KondisiRumah;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KondisiRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kondisi = DB::table('kondisi_rumahs AS kr')
                ->join( 'orang_tuas AS or' , 'kr.ortu_id' , '=' , 'or.id' )
                ->join( 'users AS us' , 'or.user_id' , '=' , 'us.id')
                -> select('kr.id' , 'us.name' , 'kr.status_rumah' , 'kr.level_bangunan' , 'kr.berkas_surat_pajak' , 'kr.photo' )
                ->paginate(10);

        return view('admin.kondisi.index',compact('kondisi'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
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
                ->select('or.id' , 'us.name')
                ->get();
        
        return view('admin.kondisi.create' , compact('ortu') );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKondisiRumahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaPhoto = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('photo')->getClientOriginalName();
        $namaPajak = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('berkas_surat_pajak')->getClientOriginalName();

        $request->photo->move(public_path('images') , $namaPhoto);
        $request->berkas_surat_pajak->move(public_path('images') , $namaPajak);

        $kondisi = KondisiRumah::create([
            "admin_id" => Auth::id(),
            "ortu_id" => $request->ortu_id,
            "status_rumah" => $request->status_rumah,
            "level_bangunan" => $request->level_bangunan,
            "berkas_surat_pajak" => $namaPajak,
            "photo" => $namaPhoto
        ]);

        return redirect()->route('kondisi.index')
                        ->with('success' , 'berhasil simpan data kondisi rumah' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KondisiRumah  $kondisiRumah
     * @return \Illuminate\Http\Response
     */
    public function show(KondisiRumah $kondisiRumah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KondisiRumah  $kondisiRumah
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $kondisi = KondisiRumah::find( $id );
        
        $ortu = DB::table('orang_tuas AS or')
                ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
                ->select('or.id' , 'us.name')
                ->get();

        return view( 'admin.kondisi.edit' , compact( 'kondisi' , 'ortu') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKondisiRumahRequest  $request
     * @param  \App\Models\KondisiRumah  $kondisiRumah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'ortu_id' => 'required'
        ]);

        // 1. ambil data kondisi berdasarkan id
        $kondisi = KondisiRumah::find( $id );

        // 2. ambil gambar
        $berkas = $kondisi->berkas_surat_pajak;
        $photo = $kondisi->photo;

        // 3. check apakah user mengubah gambar atau tidak
        // jika gambar tidak dibubah maka menggunakan gambar yang lama
        if ( $request->hasFile('berkas_surat_pajak' ) ) {
            // hapus berkas pajak yg lama
            unlink( public_path() . "/images/" . $berkas );
            // jika diganti maka dimove ke folder images
            $namaPajak = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('berkas_surat_pajak')->getClientOriginalName();

            $request->berkas_surat_pajak->move(public_path('images') , $namaPajak);
            // simpan perubahan
            $kondisi->berkas_surat_pajak = $namaPajak;
        } elseif( $request->hasFile('photo') ) {
            // hapus foto rumah yg lama
            unlink( public_path() . "/images/" . $photo );
            // jika diganti maka dimove ke folder images
            $namaPhoto = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images') , $namaPhoto);
            // simpan perubahan
            $kondisi->photo = $namaPhoto;
        } 

        $kondisi->admin_id = Auth::id();
        $kondisi->ortu_id = $request->ortu_id;
        $kondisi->status_rumah = $request->status_rumah;
        $kondisi->level_bangunan = $request->level_bangunan;
        $kondisi->save();
        

        return redirect()->route('kondisi.index')
                        ->with('success','berhasil ubah data kondisi tempat tinggal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KondisiRumah  $kondisiRumah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KondisiRumah $kondisiRumah)
    {
        //
    }

    public function hapuskondisi($id)
    {
        $kondisi = KondisiRumah::find( $id );
        $kondisi->delete();

        return redirect()->route('kondisi.index')
                        ->with('success' , 'berhasil hapus data');
    }

    public function ubahkondisi ($id)
    {
        // $namaPhoto = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('photo')->getClientOriginalName();
        // $namaPajak = rand( pow(10, 3 -1) , pow(10 , 3) -1 ) . '_' . $request->file('berkas_surat_pajak')->getClientOriginalName();

        // $request->photo->get(public_path('images') , $namaPhoto);
        // $request->berkas_surat_pajak->get(public_path('images') , $namaPajak);

        // $kondisi = KondisiRumah::where('id' , '=' , $id)->first();
        // $kondisi->photo = $request->namaPhoto;
        // $kondisi->berkas_surat_pajak = $request->namaPajak;

        // $ortu = DB::table('orang_tuas AS or')
        //         ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
        //         ->select('or.id' , 'us.name')
        //         ->get();

        // // return response()->json( $kondisi );

        // return view('admin.kondisi.edit' , compact( 'ortu' , 'kondisi' ) );
    }
}
