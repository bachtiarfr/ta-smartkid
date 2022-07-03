<?php

namespace App\Http\Controllers;

use App\Models\Ternak;
use App\Http\Requests\StoreTernakRequest;
use App\Http\Requests\UpdateTernakRequest;

class TernakController extends Controller
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
     * @param  \App\Http\Requests\StoreTernakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTernakRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ternak  $ternak
     * @return \Illuminate\Http\Response
     */
    public function show(Ternak $ternak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ternak  $ternak
     * @return \Illuminate\Http\Response
     */
    public function edit(Ternak $ternak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTernakRequest  $request
     * @param  \App\Models\Ternak  $ternak
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTernakRequest $request, Ternak $ternak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ternak  $ternak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ternak $ternak)
    {
        //
    }
}
