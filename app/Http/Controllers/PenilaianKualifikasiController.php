<?php

namespace App\Http\Controllers;

use App\Models\penilaian_kualifikasi;
use App\Http\Requests\Storepenilaian_kualifikasiRequest;
use App\Http\Requests\Updatepenilaian_kualifikasiRequest;
use Illuminate\Support\Facades\Auth;

class PenilaianKualifikasiController extends Controller
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
     * @param  \App\Http\Requests\Storepenilaian_kualifikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenilaian_kualifikasiRequest $request)
    {
        $user = Auth::user();
        $data = new penilaian_kualifikasi();
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->user_id = $user->id;
        $data->peserta_id = $request->peserta_id;
        $data->tender_id = $request->tender_id;
        $data->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penilaian_kualifikasi  $penilaian_kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(penilaian_kualifikasi $penilaian_kualifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penilaian_kualifikasi  $penilaian_kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(penilaian_kualifikasi $penilaian_kualifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenilaian_kualifikasiRequest  $request
     * @param  \App\Models\penilaian_kualifikasi  $penilaian_kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenilaian_kualifikasiRequest $request,$id)
    {
        //
        $data =  penilaian_kualifikasi::findorfail($id);
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penilaian_kualifikasi  $penilaian_kualifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(penilaian_kualifikasi $penilaian_kualifikasi)
    {
        //
    }
}
