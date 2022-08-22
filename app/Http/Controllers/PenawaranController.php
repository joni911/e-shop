<?php

namespace App\Http\Controllers;

use App\Models\penawaran;
use App\Http\Requests\StorepenawaranRequest;
use App\Http\Requests\UpdatepenawaranRequest;

class PenawaranController extends Controller
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
     * @param  \App\Http\Requests\StorepenawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepenawaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function show(penawaran $penawaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(penawaran $penawaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepenawaranRequest  $request
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepenawaranRequest $request, penawaran $penawaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(penawaran $penawaran)
    {
        //
    }
}
