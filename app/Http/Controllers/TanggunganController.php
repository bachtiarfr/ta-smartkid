<?php

namespace App\Http\Controllers;

use App\Models\Tanggungan;
use App\Http\Requests\StoreTanggunganRequest;
use App\Http\Requests\UpdateTanggunganRequest;

class TanggunganController extends Controller
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
     * @param  \App\Http\Requests\StoreTanggunganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTanggunganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggungan  $tanggungan
     * @return \Illuminate\Http\Response
     */
    public function show(Tanggungan $tanggungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggungan  $tanggungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanggungan $tanggungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTanggunganRequest  $request
     * @param  \App\Models\Tanggungan  $tanggungan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTanggunganRequest $request, Tanggungan $tanggungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggungan  $tanggungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanggungan $tanggungan)
    {
        //
    }
}
