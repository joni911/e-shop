<?php

namespace App\Http\Controllers;

use App\Models\koreksi;
use App\Http\Requests\StorekoreksiRequest;
use App\Http\Requests\UpdatekoreksiRequest;
use App\Models\peserta;

class KoreksiController extends Controller
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
     * @param  \App\Http\Requests\StorekoreksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekoreksiRequest $request)
    {

        $data = peserta::findorfail($request->id);
        if ($data->harga_koreksi) {
            return redirect()->back()->with(['warning-limit' => 'Koreksi hanya bisa dilakukan 1 kali']);
        }
        $data->harga_koreksi = $request->koreksi;
        $data->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\koreksi  $koreksi
     * @return \Illuminate\Http\Response
     */
    public function show(koreksi $koreksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\koreksi  $koreksi
     * @return \Illuminate\Http\Response
     */
    public function edit(koreksi $koreksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekoreksiRequest  $request
     * @param  \App\Models\koreksi  $koreksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekoreksiRequest $request, koreksi $koreksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\koreksi  $koreksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(koreksi $koreksi)
    {
        //
    }
}
