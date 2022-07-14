<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\Assets;
use App\Models\Ternak;
use App\Models\Penghasilan;
use App\Models\TanggunganAnak;
use App\Models\Asuransi;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\User;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Siswa_Prestasi;
use Str;

use DB;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // query builder
        $siswa = DB::table('siswas AS sw')
            ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
            ->select('sw.user_id' , 'us.nama_depan', 'us.nama_belakang')
            ->groupBy('sw.id')
            ->groupBy('us.nama_depan')
            ->groupBy('us.nama_belakang')
            ->orderBy('us.nama_depan')
            ->get();

        // elequent with => menciptakan nested array
        $rumah = Rumah::with('rumahdetail')->get();
        $assets = Assets::with('assetsdetail')->get();
        $ternak = Ternak::with('ternakdetail')->get();
        // query builder
        $penghasilan = Penghasilan::all();
        $tanggungan = TanggunganAnak::all();
        $asuransi = Asuransi::all();

        return view('daftar-beasiswa', compact('ternak' , 'assets' , 'rumah' , 'siswa' , 'penghasilan' , 'tanggungan' , 'asuransi'));
    }


    public function hasilPengumuman() 
    {
        $dataPenerima = DB::table('penerimas')->select('nama_penerima')->get();
        // dd($dataPenerima);
        return view('hasil-pengumuman', compact('dataPenerima'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('berkas_surat') != null) {
            
            $fileTypeOrtu = $request->berkas_surat->getClientOriginalExtension();
            
            if ($fileTypeOrtu != 'pdf') {
                return "File harus pdf";
            }
            
            $namaBerkasOrtu = $request->file('berkas_surat')->getClientOriginalName();
            $request->berkas_surat->move(public_path('pdf') , $namaBerkasOrtu);
        }
        if ($request->file('berkas_prestasi') != null) {

            $fileType = $request->berkas_prestasi->getClientOriginalExtension();

            if ($fileType != 'pdf') {
                return "File harus pdf";
            }
    
            $namaBerkas = $request->file('berkas_prestasi')->getClientOriginalName();
            $request->berkas_prestasi->move(public_path('pdf') , $namaBerkas);

        }

        // //1. simpan ke tabel user
        $user = User::create([
            "nama_depan" => $request->nama_depan,
            "nama_belakang" => $request->nama_belakang,
            "email" => Str::lower($request->nama_depan . "@gmail.com"),
            "password" => bcrypt("rahasia123")
        ]);
        
         // //2. simpan ke tabel user orang tua
         $userOrtu = User::create([
            "nama_depan" => $request->nama_orangtua_depan,
            "nama_belakang" => $request->nama_orangtua_belakang,
            "email" => Str::lower($request->nama_orangtua_depan . "@gmail.com"),
            "password" => bcrypt("rahasia123")
        ]);
        
        // simpan data ortu
        $ortu = OrangTua::create([
            "user_id" => $userOrtu->id,
            "status" => $request->status,
            "nik" => $request->nik,
            "pendidikan" => $request->pendidikan,
            "pekerjaan" => $request->pekerjaan,
            "berkas_surat" => $namaBerkasOrtu
        ]);

        
        // //3. simpan ke tabel siswa
        $siswa = Siswa::create([
            "user_id" => $user->id,
            "ortu_id" => $userOrtu->id,
            "nisn" => $request->nisn,
            "jk" => $request->jk,
            "jurusan" => $request->jurusan,
            "kelas" => $request->kelas,
            "berkas_prestasi" => $namaBerkas
        ]);

        $penghasilan = DB::table("penghasilans")->select("bobot")->where("id", $request->penghasilan_id)->first();
        $tanggungan = DB::table("tanggungan_anaks")->select("nilai")->where("id", $request->tanggungan_id)->first();
        $asset = DB::table("assets_details")->select("value")->where("assets_id", $request->assets_id)->first();
        $asuransi = DB::table("asuransis")->select("nilai")->where("id", $request->asuransi_id)->first();
        $valueRumah = DB::table("rumah_details")->select("value")->where("id", $request->rumah_id)->first();

        $c1 = $penghasilan->bobot;
        $c2 = $request->rumah_id;
        $c3 = $asset->value;
        $c4 = $tanggungan->nilai;
        $c5 = $asuransi->nilai;
        
        $dataPenilaian = Penilaian::create([
            "siswa_id" => $siswa->id,
            "penghasilan_id" => $request->penghasilan_id,
            "tanggungan_id" => $request->tanggungan_id,
            "asuransi_id" => $request->asuransi_id,
            "c1" => $c1,
            "c2" => $c2,
            "c3" => $c3,
            "c4" => $c4,
            "c5" => $c5
        ]); 

        PenilaianDetail::create([
            "penilaian_id" => $dataPenilaian->id,
            "rumah_id" => $request->rumah_id,
            "assets_id" => $request->assets_id,
            "value_assets" => $c3,
            "value_rumah" => $valueRumah->value,
        ]);

        // 4. simpan data prestasi sesuai clone ajax
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

        
        return redirect('daftar-beasiswa-post')->with('success' , 'berhasil simpan data siswa' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
