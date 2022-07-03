<?php

namespace App\Http\Controllers;

use App\Models\PenilaianDetail;
use App\Http\Requests\StorePenilaianDetailRequest;
use App\Http\Requests\UpdatePenilaianDetailRequest;

class PenilaianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePenilaianDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenilaianDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenilaianDetail  $penilaianDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PenilaianDetail $penilaianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenilaianDetail  $penilaianDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PenilaianDetail $penilaianDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianDetailRequest  $request
     * @param  \App\Models\PenilaianDetail  $penilaianDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenilaianDetailRequest $request, PenilaianDetail $penilaianDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenilaianDetail  $penilaianDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianDetail $penilaianDetail)
    {
        //
    }
}
