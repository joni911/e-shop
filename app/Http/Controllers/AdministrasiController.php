<?php

namespace App\Http\Controllers;

use App\Models\administrasi;
use App\Http\Requests\StoreadministrasiRequest;
use App\Http\Requests\UpdateadministrasiRequest;
use App\Models\penawaran;
use App\Models\penawaran_file;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

class AdministrasiController extends Controller
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
     * @param  \App\Http\Requests\StoreadministrasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadministrasiRequest $request)
    {
        // return $request;
        $user = Auth::user();
        $data = new administrasi();
        $data->nama = $request->nama;
        $data->user_id = $user->id;
        $data->tender_id =$request->id;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\administrasi  $administrasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tender = tender::findorfail($id);


        $file = administrasi::where('tender_id',$id)->get();



        return view('tender_user.peserta.administrasi.index',['tender'=>$tender,'file'=>$file]);
        // return view('tender_user.peserta.administrasi.index',['tender'=>$tender]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\administrasi  $administrasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateadministrasiRequest  $request
     * @param  \App\Models\administrasi  $administrasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateadministrasiRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\administrasi  $administrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = administrasi::findorfail($id);
        $data->delete();
        return redirect()->back();
    }
}
