<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class OrangTuaController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:ortu-list|ortu-create|ortu-edit|ortu-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:ortu-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:ortu-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:ortu-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ortu = OrangTua::latest()->paginate(5);
        $ortu = DB::table('orang_tuas AS or')
                ->select('or.id' , 'us.nama_depan', 'us.nama_belakang' , 'or.nik' , 'or.status' , 'or.pendidikan' , 'or.pekerjaan' )
                ->join('users AS us' , 'or.user_id' , '=' , 'us.id')
                ->paginate(10);

        // return response()->json( $ortu );


        return view('admin.ortu.index',compact('ortu'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::all();

        return view( 'admin.ortu.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrangTuaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('berkas_surat') != null) {
            
            $fileTypeOrtu = $request->berkas_surat->getClientOriginalExtension();
            
            if ($fileTypeOrtu != 'pdf') {
                return "File harus pdf";
            }
            
            $namaBerkas = $request->file('berkas_surat')->getClientOriginalName();
            $request->berkas_surat->move(public_path('pdf') , $namaBerkas);
        }
        // simpan data user ortu
        $user = User::create([
            "nama_depan" => $request->nama_depan,
            "nama_belakang" => $request->nama_belakang,
            "email" => Str::lower($request->nama_depan . "@gmail.com"),
            "password" => bcrypt("rahasia123")
        ]);

        // simpan data ortu
        $ortu = OrangTua::create([
            "user_id" => $user->id,
            "status" => $request->status,
            "nik" => $request->nik,
            "berkas_surat" => $namaBerkas,
            "pendidikan" => $request->pendidikan,
            "pekerjaan" => $request->pekerjaan
        ]);
    
        // OrangTua::create( $request->all() );
        return redirect()->route('orangtua.index')->with('success','berhasil simpan data orangtua');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function show(OrangTua $orangTua)
    {
        return view('admin.ortu.show',compact('orangTua') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function edit(OrangTua $orangTua)
    {
        return view('admin.ortu.edit',compact('orangTua') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrangTuaRequest  $request
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        request()->validate([
            'user_id' => 'required',
            'nik' => 'required',
        ]);
        
        $ortu = OrangTua::find($id);

        $ortu->user_id = $request->user_id;
        $ortu->status = $request->status;
        $ortu->nik = $request->nik;
        $ortu->pendidikan = $request->pendidikan;
        $ortu->pekerjaan = $request->pekerjaan;
        $ortu->save();

        $user = DB::table('users')
            ->where("id", $request->user_id)
            ->update([
                "nama_depan" => $request->nama_depan,
                "nama_belakang" => $request->nama_belakang
            ]);
        return redirect()->route('orangtua.index')
                        ->with('success','berhasil ubah data orang tua');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        $product->delete();
    
        return redirect()->route('orangtua.index')->with('success','Product deleted successfully');
    }


    public function hapusortu( $id )
    {
        $ortu = OrangTua::find($id);
        $ortu->delete();

        return redirect()->route('orangtua.index')->with('success','berhasil hapus data orang tua');
    }

    public function ubahortu( $id )
    {
        $ortu = DB::table('orang_tuas as ot')
            ->select("ot.id as id", "us.nama_depan", "us.nama_belakang", "ot.status", "ot.nik", "ot.pendidikan", "ot.pekerjaan")
            ->join("users as us", "ot.user_id", "=", "us.id")
            ->where("ot.id", "=", $id)
            ->first();
        // $ortu = OrangTua::where('id' , '=' , $id)->first();
        $user = User::all();

        return view('admin.ortu.edit' , compact('user' , 'ortu') );
    }
}
