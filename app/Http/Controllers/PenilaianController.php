<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Siswa;
use App\Models\Penghasilan;
use App\Models\TanggunganAnak;
use App\Models\Asuransi;
use App\Models\Rumah;
use App\Models\RumahDetail;
use App\Models\Assets;
use App\Models\Penerima;
use App\Models\Ternak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use PDF;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        // $data = DB::table('penilaians AS pn')
        //         ->join('penilaian_details AS pnd' , 'pn.id' , '=' , 'pnd.penilaian_id')
        //         ->select('pn.id' , 'pn.c1' , 'pn.c2' , 'pn.c3' , 'pn.c4' , 'pn.c5' , 'pn.c6')
        //         ->get();

        $siswa = DB::table('siswas AS sw')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->select( 'us.nama_depan', 'us.nama_belakang')
                ->get();

        $data = DB::table('penilaians AS pn')
                ->select('pn.id' , 'pn.c1' , 'pn.c2' , 'pn.c3' , 'pn.c4' , 'pn.c5')
                ->get();


        // datatable
        if ($request->ajax()) {

            // $data = Penilaian::all();

            return Datatables::of( $data )
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="#" class="edit btn btn-danger btn-sm">Hapus</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.penilaian.index');
        // return response()->json($data);
    }

    public function accBeasiswa(Request $request) 
    {
        return DB::table('penerimas')->insert([
            'siswa_id'=> $request->dataSiswaID
        ]);
    }

    public function hitungpenilaian (  )
    {
        $dataPenilaian = DB::table('penilaians AS pnl')
                ->select('sw.nisn', 'sw.kelas', 'pnl.id' , 'pnl.siswa_id', 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5', 'pnl.created_at')
                ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
                ->get();
                // dd($dataPenilaian);

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
        // dd($penilaian);

        return view('admin.penilaian.hitung' , compact('penilaian', 'dataNormalisasi', 'dataPerangkingan'));
    }

    public function penerimaBeasiswa()
    {
        $dataPenilaian = DB::table('penilaians AS pnl')
                ->select('sw.nisn', 'sw.kelas', 'pnl.id' , 'pn.siswa_id', 'pnl.siswa_id', 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5', 'pnl.created_at')
                ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
                ->join('penerimas as pn', 'pnl.siswa_id', 'pn.siswa_id')
                ->get();
                // dd($dataPenilaian);

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
        // dd($penilaian);

        return view('admin.penerima.index' , compact('penilaian', 'dataNormalisasi', 'dataPerangkingan'));
    }

    public function printPDF() 
    {
        $dataPenilaian = DB::table('penilaians AS pnl')
                ->select('sw.nisn', 'sw.kelas', 'pnl.id' , 'pn.siswa_id', 'pnl.siswa_id', 'us.nama_depan', 'us.nama_belakang', 'sw.berkas_prestasi', 'ortu.berkas_surat', 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5', 'pnl.created_at')
                ->join('siswas AS sw' , 'pnl.siswa_id' , '=' , 'sw.user_id')
                ->join('users AS us' , 'sw.user_id' , '=' , 'us.id')
                ->join('orang_tuas AS ortu' , 'sw.ortu_id' , '=' , 'ortu.user_id')
                ->join('penerimas as pn', 'pnl.siswa_id', 'pn.siswa_id')
                ->get();
                // dd($dataPenilaian);

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


        $pdf = PDF::loadview('beasiswa-print',['dataPerangkingan'=>$dataPerangkingan])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('data-beasiswa.pdf');
    }

    public function getpenilaian(  )
    {
        $penilaian = DB::table('penilaians AS pnl')
                ->join('users AS us' , 'pnl.siswa_id' , '=' , 'us.id')
                ->select('pnl.id' , 'us.nama_depan', 'us.nama_belakang' , 'pnl.c1' , 'pnl.c2' , 'pnl.c3' , 'pnl.c4' , 'pnl.c5')
                ->get();

        return response()->json($penilaian);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('admin.penilaian.create' , compact('ternak' , 'assets' , 'rumah' , 'siswa' , 'penghasilan' , 'tanggungan' , 'asuransi'));
        
        // return response()->json($rumah);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenilaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dataPenilaian = Penilaian::create([
            "siswa_id" => $request->siswa_id,
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
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianRequest  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
