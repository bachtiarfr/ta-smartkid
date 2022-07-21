<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
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
use App\Models\Penerima;

use Carbon;
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
        // $siswa = DB::table('siswas AS sw')
        //     ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
        //     ->select('sw.user_id' , 'us.nama_depan', 'us.nama_belakang')
        //     ->groupBy('sw.id')
        //     ->groupBy('us.nama_depan')
        //     ->groupBy('us.nama_belakang')
        //     ->orderBy('us.nama_depan')
        //     ->get();

        // elequent with => menciptakan nested array
        $rumah = Rumah::with('rumahdetail')->get();
        $assets = Assets::with('assetsdetail')->get();
        $ternak = Ternak::with('ternakdetail')->get();
        // query builder
        $penghasilan = Penghasilan::all();
        $tanggungan = TanggunganAnak::all();
        $asuransi = Asuransi::all();

        return view('daftar-beasiswa', compact('ternak' , 'assets' , 'rumah' , 'penghasilan' , 'tanggungan' , 'asuransi'));
    }


    public function hasilPengumuman()
    {
       
        $dataPenilaian = DB::table('penilaians AS pnl')
                ->select('sw.nisn', 'sw.kelas', 'pnl.id', 'pn.created_at' , 'pn.siswa_id', 'pnl.siswa_id', 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
                ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
                ->join('penerimas as pn', 'pnl.siswa_id', 'pn.siswa_id')
                ->get();
                // dd($dataPenilaian);
                
        $dataPeriod = DB::table('penerimas')
                ->select("created_at")
                ->get();
                foreach ($dataPeriod as $key => $p) {
                    $periode[] = \Carbon\Carbon::parse($p->created_at)->format("Y");
                }
        $periode = array_unique($periode);

        // cari max value dari setiap kriteria
        $nValue = [
            "minC1" => floatval(DB::table("penilaians")->min("c1")),
            "minC2" => floatval(DB::table("penilaians")->min("c2")),
            "minC3" => floatval(DB::table("penilaians")->min("c3")),
            "maxC4" => floatval(DB::table("penilaians")->max("c4")),
            "minC5" => floatval(DB::table("penilaians")->min("c5")),
        ];

        $dataPenerima = DB::table("penerimas")
            ->select("siswa_id")
            ->get();
        // proses normalisasi
        foreach ($dataPenilaian as $dataNilai) {
            if ($nValue["minC1"] == 0) {
                $dataNilai->c1 = 1;
            } 
            
            if ($nValue["minC2"] == 0) {
                $dataNilai->c2 = 1;
            } 
    
            if ($nValue["minC3"] == 0) {
                $dataNilai->c3 = 1;
            } 
            
            if ($dataNilai->c4 == 0) {
                $nValue["maxC4"] = 1;
            } 
            
            if ($nValue["minC5"] == 0) {
                $dataNilai->c5 = 1;
            } 

            // dd($dataNilai->c1);
            $dataStatus = 0;
            foreach ($dataPenerima as $key => $penerima) {
                if ($dataNilai->siswa_id == $penerima->siswa_id) {
                    $dataStatus = 1;
                }
            }            
            $dataNormalisasi[] = [
                "nama" => $dataNilai->nama_depan . ' ' . $dataNilai->nama_belakang,
                "nisn" => $dataNilai->nisn,
                "siswa_id" => $dataNilai->siswa_id,
                "kelas" => $dataNilai->kelas,
                "r1" => round($nValue["minC1"] / $dataNilai->c1, 2), 
                "r2" => round($nValue["minC2"] / $dataNilai->c2, 2), 
                "r3" => round($nValue["minC3"] / $dataNilai->c3, 2), 
                "r4" => round($dataNilai->c4 / $nValue["maxC4"], 2), 
                "r5" => round($nValue["minC5"] / $dataNilai->c5, 2),
                "status" => $dataStatus,
                "periode" => \Carbon\Carbon::parse($dataNilai->created_at)->format('Y'),
                "berkas_prestasi" => $dataNilai->berkas_prestasi,
                "berkas_surat" => $dataNilai->berkas_surat
            ];
        }

        // dd($dataNormalisasi);

        // nilai normalisasi dikali dengan bobot
        foreach ($dataNormalisasi as $key => $v) {
            $dataPerangkingan[] = [
                "nama" => $v["nama"],
                "nisn" => $v["nisn"],
                "kelas" => $v["kelas"],
                "siswa_id" => $v["siswa_id"],
                "v1" => round(($v["r1"]*0.25), 2),
                "v2" => round(($v["r2"]*0.20), 2),
                "v3" => round(($v["r3"]*0.15), 2),
                "v4" => round(($v["r4"]*0.30), 2),
                "v5" => round(($v["r5"]*0.10), 2),
                "berkas_prestasi" => $v['berkas_prestasi'],
                "berkas_surat" => $v['berkas_surat'],
                "periode" => $v["periode"],
                "status" => $v["status"],
                "w" => (round(($v["r1"]*0.25), 2)) + (round(($v["r2"]*0.20), 2)) + (round(($v["r3"]*0.15), 2)) + (round(($v["r4"]*0.15), 2)) + (round(($v["r5"]*0.30), 2))
            ];
        }
        // dd($dataPerangkingan);

        $penilaian = DB::table('penilaians AS pnl')
            ->select('sw.nisn', 'sw.kelas', 'pnl.id' , 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
            ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
            ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
            ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
            ->get();

        return view('hasil-pengumuman', compact('penilaian', 'periode', 'dataNormalisasi', 'dataPerangkingan'));
    }

    public function hasilPengumumanByPeriode(Request $period)
    {
        // return $period;
        $post = Penerima::get();
        $dataPenilaian = DB::table('penilaians AS pnl')
                ->select('sw.nisn', 'sw.kelas', 'pnl.id' , Carbon\Carbon::createFromFormat('Y-m-d', 'pn.created_at')->format('Y-m-d') , 'pn.siswa_id', 'pnl.siswa_id', 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5', 'pnl.created_at')
                ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
                ->join('penerimas as pn', 'pnl.siswa_id', 'pn.siswa_id')
                // ->where('pn.created_at', $period)
                ->get();
        return $dataPenilaian;
                
        $dataPeriod = DB::table('penilaians')
                ->select("created_at")
                ->get();

        foreach ($dataPeriod as $key => $p) {
            $periode[] = \Carbon\Carbon::parse($p->created_at)->format("Y");
        }
        $periode = array_unique($periode);

        // cari max value dari setiap kriteria
        $nValue = [
            "minC1" => floatval(DB::table("penilaians")->min("c1")),
            "minC2" => floatval(DB::table("penilaians")->min("c2")),
            "minC3" => floatval(DB::table("penilaians")->min("c3")),
            "maxC4" => floatval(DB::table("penilaians")->max("c4")),
            "minC5" => floatval(DB::table("penilaians")->min("c5")),
        ];

        $dataPenerima = DB::table("penerimas")
            ->select("siswa_id")
            ->get();
        // proses normalisasi
        foreach ($dataPenilaian as $dataNilai) {
            if ($nValue["minC1"] == 0) {
                $dataNilai->c1 = 1;
            } 
            
            if ($nValue["minC2"] == 0) {
                $dataNilai->c2 = 1;
            } 
    
            if ($nValue["minC3"] == 0) {
                $dataNilai->c3 = 1;
            } 
            
            if ($dataNilai->c4 == 0) {
                $nValue["maxC4"] = 1;
            } 
            
            if ($nValue["minC5"] == 0) {
                $dataNilai->c5 = 1;
            } 

            // dd($dataNilai->c1);
            $dataStatus = 0;
            foreach ($dataPenerima as $key => $penerima) {
                if ($dataNilai->siswa_id == $penerima->siswa_id) {
                    $dataStatus = 1;
                }
            }            
            $dataNormalisasi[] = [
                "nama" => $dataNilai->nama_depan . ' ' . $dataNilai->nama_belakang,
                "nisn" => $dataNilai->nisn,
                "siswa_id" => $dataNilai->siswa_id,
                "kelas" => $dataNilai->kelas,
                "r1" => round($nValue["minC1"] / $dataNilai->c1, 2), 
                "r2" => round($nValue["minC2"] / $dataNilai->c2, 2), 
                "r3" => round($nValue["minC3"] / $dataNilai->c3, 2), 
                "r4" => round($dataNilai->c4 / $nValue["maxC4"], 2), 
                "r5" => round($nValue["minC5"] / $dataNilai->c5, 2),
                "status" => $dataStatus,
                "periode" => \Carbon\Carbon::parse($dataNilai->created_at)->format('Y-m-d'),
                "berkas_prestasi" => $dataNilai->berkas_prestasi,
                "berkas_surat" => $dataNilai->berkas_surat
            ];
        }

        // dd($dataNormalisasi);

        // nilai normalisasi dikali dengan bobot
        foreach ($dataNormalisasi as $key => $v) {
            if ($v["periode"] == $period) {
                $dataPerangkingan[] = [
                    "nama" => $v["nama"],
                    "nisn" => $v["nisn"],
                    "kelas" => $v["kelas"],
                    "siswa_id" => $v["siswa_id"],
                    "v1" => round(($v["r1"]*0.25), 2),
                    "v2" => round(($v["r2"]*0.20), 2),
                    "v3" => round(($v["r3"]*0.15), 2),
                    "v4" => round(($v["r4"]*0.30), 2),
                    "v5" => round(($v["r5"]*0.10), 2),
                    "berkas_prestasi" => $v['berkas_prestasi'],
                    "berkas_surat" => $v['berkas_surat'],
                    "periode" => $v["periode"],
                    "status" => $v["status"],
                    "w" => (round(($v["r1"]*0.25), 2)) + (round(($v["r2"]*0.20), 2)) + (round(($v["r3"]*0.15), 2)) + (round(($v["r4"]*0.15), 2)) + (round(($v["r5"]*0.30), 2))
                ];
            }
        }
        dd($dataPerangkingan);

        $penilaian = DB::table('penilaians AS pnl')
            ->select('sw.nisn', 'sw.kelas', 'pnl.id' , 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
            ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
            ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
            ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
            ->get();

        return view('hasil-pengumuman', compact('penilaian', 'periode', 'dataNormalisasi', 'dataPerangkingan'));
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
        // return $request->prestasis;

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
        
        if (User::where('email', '=', $request->nama_orangtua_depan . "@gmail.com")->count() > 0) {
            // user found
            $emailOrtu = $request->nama_orangtua_depan . rand(1,50) . "@gmail.com";
        }

        if (User::where('email', '=', $request->nama_depan . "@gmail.com")->count() > 0) {
            // user found
            $emailSiswa = $request->nama_depan . rand(1,50) . "@gmail.com";
        }

         // //2. simpan ke tabel user orang tua
         $userOrtu = User::create([
            "nama_depan" => $request->nama_orangtua_depan,
            "nama_belakang" => $request->nama_orangtua_belakang,
            "email" => Str::lower($emailOrtu),
            "password" => bcrypt("rahasia123")
        ]);

        // //1. simpan ke tabel user
        $user = User::create([
            "nama_depan" => $request->nama_depan,
            "nama_belakang" => $request->nama_belakang,
            "email" => Str::lower($emailSiswa),
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
            "ortu_id" => $ortu->user_id,
            "nisn" => $request->nisn,
            "jk" => $request->jk,
            "jurusan" => $request->jurusan,
            "kelas" => $request->kelas,
            "berkas_prestasi" => $namaBerkas
        ]);

         // 4. simpan data prestasi sesuai clone ajax
         Siswa_Prestasi::create([
             "siswa_id" => $siswa->id,
             "prestasi" => $request->prestasis
         ]);
        
        $dataPenilaian = Penilaian::create([
            "siswa_id" => $siswa->user_id,
            "penghasilan_id" => $request->penghasilan_id,
            "tanggungan_id" => $request->tanggungan_id,
            "asuransi_id" => $request->asuransi_id,
            "c1" => $request->c1,
            "c2" => $request->c2,
            "c3" => $request->c3,
            "c4" => $request->c4,
            "c5" => $request->c5
        ]); 

        PenilaianDetail::create([
            "penilaian_id" => $dataPenilaian->id,
            "rumah_id" => $request->rumah_id,
            "assets_id" => $request->asset_id,
            "value_assets" => $request->asset_value,
            "value_rumah" => $request->rumah_data,
        ]);

        return response()->json([
            "message" =>  "data berhasil disimpan", 
        ]);
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
