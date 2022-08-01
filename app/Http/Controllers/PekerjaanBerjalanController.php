<?php

namespace App\Http\Controllers;

use App\Models\pekerjaan_berjalan;
use App\Http\Requests\Storepekerjaan_berjalanRequest;
use App\Http\Requests\Updatepekerjaan_berjalanRequest;
use App\Models\peserta;
use Illuminate\Support\Facades\Auth;

class PekerjaanBerjalanController extends Controller
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
     * @param  \App\Http\Requests\Storepekerjaan_berjalanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepekerjaan_berjalanRequest $request)
    {
        $user = Auth::user();
        $data = new pekerjaan_berjalan();
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->user_id = $user->id;
        $data->lokasi = $request->lokasi;
        $data->instansi = $request->instansi;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_kontrak = $request->no_kontrak;
        $data->tgl_kontrak = $request->tgl_kontrak;
        $data->presentasi = $request->presentasi;
        $data->tgl_selesai_kontrak = $request->tgl_selesai_kontrak;
        $data->tgl_serah_terima = $request->tgl_serah_terima;
        $data->keterangan = $request->keterangan;
        $data->pekerjaan = $request->pekerjaan;
        $data->nilai_kontrak = $request->nilai_kontrak;
        $data->save();

        return redirect()->back()->with('success','Data '.$data->pekerjaan.' telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pekerjaan_berjalan  $pekerjaan_berjalan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = peserta::findorfail($id);
        $list = pekerjaan_berjalan::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.pekerjaan_berjalan.create',['peserta'=>$p,'list'=>$list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pekerjaan_berjalan  $pekerjaan_berjalan
     * @return \Illuminate\Http\Response
     */
    public function edit(pekerjaan_berjalan $pekerjaan_berjalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepekerjaan_berjalanRequest  $request
     * @param  \App\Models\pekerjaan_berjalan  $pekerjaan_berjalan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepekerjaan_berjalanRequest $request, pekerjaan_berjalan $pekerjaan_berjalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pekerjaan_berjalan  $pekerjaan_berjalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pekerjaan_berjalan $pekerjaan_berjalan)
    {
        //
    }
}
