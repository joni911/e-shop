<?php

namespace App\Http\Controllers;

use App\Models\penilaian_administrasi;
use App\Http\Requests\Storepenilaian_administrasiRequest;
use App\Http\Requests\Updatepenilaian_administrasiRequest;
use Illuminate\Support\Facades\Auth;

class PenilaianAdministrasiController extends Controller
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
     * @param  \App\Http\Requests\Storepenilaian_administrasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenilaian_administrasiRequest $request)
    {
        // return $request;
        $user = Auth::user();
        $data = new penilaian_administrasi();
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
     * @param  \App\Models\penilaian_administrasi  $penilaian_administrasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penilaian_administrasi  $penilaian_administrasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenilaian_administrasiRequest  $request
     * @param  \App\Models\penilaian_administrasi  $penilaian_administrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenilaian_administrasiRequest $request, $id)
    {
        //
        $data = penilaian_administrasi::findorfail($id);
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penilaian_administrasi  $penilaian_administrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
