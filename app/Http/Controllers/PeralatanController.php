<?php

namespace App\Http\Controllers;

use App\Models\peralatan;
use App\Http\Requests\StoreperalatanRequest;
use App\Http\Requests\UpdateperalatanRequest;
use App\Models\peserta;
use Illuminate\Support\Facades\Auth;

class PeralatanController extends Controller
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
     * @param  \App\Http\Requests\StoreperalatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreperalatanRequest $request)
    {
        $user = Auth::user();
        $data = new peralatan();
        $data->nama = $request->nama;
        $data->tender_id = $request->tender_id;
        $data->peserta_id = $request->id;
        $data->user_id = $user->id;
        $data->jumlah = $request->jumlah;
        $data->kapasitas = $request->kapasitas;
        $data->merk = $request->merk;
        $data->tahun = $request->tahun;
        $data->kondisi = $request->kondisi;
        $data->lokasi = $request->lokasi;
        $data->kepemilikan = $request->kepemilikan;
        $data->bukti = $request->bukti;
        $data->save();
        return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = peserta::findorfail($id);
        $list = peralatan::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.peralatan.create',['peralatan'=>$p,'list'=>$list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit(peralatan $peralatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateperalatanRequest  $request
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateperalatanRequest $request, peralatan $peralatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(peralatan $peralatan)
    {
        //
    }
}
