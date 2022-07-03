<?php

namespace App\Http\Controllers;

use App\Models\JenisBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;


class JenisBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.beasiswa.index');
    }

    public function getBeasiswa ( Request $request )
    {
        

        if ( $request->ajax() ) {

            $data = JenisBeasiswa::all();

            return \DataTables::of( $data )
                ->addColumn('Actions' , function( $data ) {
                    return '<button type="button" class="btn btn-success btn-sm" id="btnEdit" data-id="' . $data->id . '">Edit</button>
                        <button type="button" data-id="' . $data->id . '" data-toggle="modal" data-target="#DeleteBeasiswaModal" class="btn btn-danger btn-sm" id="btnDelete">Delete</button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beasiswa = DB::table('jenis_beasiswas AS jb')
                -> select( 'jb.beasiswa' )
                ->get();
        
        return view('admin.beasiswa.create' , compact('beasiswa') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJenisBeasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $data = JenisBeasiswa::create( $request->all() );

        return response()->json( ['pesan' => 'data berhasil disimpan'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisBeasiswa  $jenisBeasiswa
     * @return \Illuminate\Http\Response
     */ 
    public function show( $id )
    {
        $jenisBeasiswa = JenisBeasiswa::find( $id );

        return response()->json( $jenisBeasiswa );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisBeasiswa  $jenisBeasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisBeasiswa $jenisBeasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJenisBeasiswaRequest  $request
     * @param  \App\Models\JenisBeasiswa  $jenisBeasiswa
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $data = JenisBeasiswa::find( $id );
        $data->nama_beasiswa = $request->nama_beasiswa;
        $data->user_id = $request->user_id;
        $data->save();

        return response()->json( ['pesan' => 'data berhasil disimpan'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisBeasiswa  $jenisBeasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $data = JenisBeasiswa::find( $id );
        $data->delete();

        return response()->json( ['pesan' => 'data berhasil dihapus'] );
    }

}
