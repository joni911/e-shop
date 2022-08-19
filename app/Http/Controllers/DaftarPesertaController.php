<?php

namespace App\Http\Controllers;

use App\Models\daftar_peserta;
use App\Http\Requests\Storedaftar_pesertaRequest;
use App\Http\Requests\Updatedaftar_pesertaRequest;
use Illuminate\Support\Facades\Auth;

class DaftarPesertaController extends Controller
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
     * @param  \App\Http\Requests\Storedaftar_pesertaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedaftar_pesertaRequest $request)
    {
        //
        $user = Auth::user();
        $data  = new daftar_peserta();
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->user_id = $user->id;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\daftar_peserta  $daftar_peserta
     * @return \Illuminate\Http\Response
     */
    public function show(daftar_peserta $daftar_peserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\daftar_peserta  $daftar_peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(daftar_peserta $daftar_peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedaftar_pesertaRequest  $request
     * @param  \App\Models\daftar_peserta  $daftar_peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedaftar_pesertaRequest $request, daftar_peserta $daftar_peserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\daftar_peserta  $daftar_peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(daftar_peserta $daftar_peserta)
    {
        //
    }
}