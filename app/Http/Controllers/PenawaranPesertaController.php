<?php

namespace App\Http\Controllers;

use App\Models\penawaran_peserta;
use App\Http\Requests\Storepenawaran_pesertaRequest;
use App\Http\Requests\Updatepenawaran_pesertaRequest;

class PenawaranPesertaController extends Controller
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
     * @param  \App\Http\Requests\Storepenawaran_pesertaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenawaran_pesertaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function show(penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenawaran_pesertaRequest  $request
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenawaran_pesertaRequest $request, penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(penawaran_peserta $penawaran_peserta)
    {
        //
    }
}
