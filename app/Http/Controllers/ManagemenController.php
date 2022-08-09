<?php

namespace App\Http\Controllers;

use App\Models\managemen;
use App\Http\Requests\StoremanagemenRequest;
use App\Http\Requests\UpdatemanagemenRequest;
use App\Models\peserta;
use Illuminate\Support\Facades\Auth;

class ManagemenController extends Controller
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
     * @param  \App\Http\Requests\StoremanagemenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoremanagemenRequest $request)
    {
        $user = Auth::user();
        $data = new managemen();
        $data->user_id = $user->id;
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->nama = $request->nama;
        $data->tgl_menjabat = $request->tgl_menjabat;
        $data->tgl_berakhir = $request->tgl_berakhir;
        $data->ktp = $request->ktp;
        $data->alamat = $request->alamat;
        $data->npwp = $request->npwp;
        $data->status = $request->status;
        $data->save();
        return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = peserta::findorfail($id);
        $list = managemen::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.managemen.create',['managemen'=>$p,'list'=>$list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function edit(managemen $managemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemanagemenRequest  $request
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemanagemenRequest $request, managemen $managemen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function destroy(managemen $managemen)
    {
        //
    }
}
