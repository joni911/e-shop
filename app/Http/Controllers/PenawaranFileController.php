<?php

namespace App\Http\Controllers;

use App\Models\penawaran_file;
use App\Http\Requests\Storepenawaran_fileRequest;
use App\Http\Requests\Updatepenawaran_fileRequest;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

class PenawaranFileController extends Controller
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
     * @param  \App\Http\Requests\Storepenawaran_fileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenawaran_fileRequest $request)
    {
         $user = Auth::user();

         $penawaran_file = tender::findorfail($request->id);

         $data = new penawaran_file();
         $data->user_id = $user->id;
         $data->penawaran_id = $penawaran_file->penawaran->id;
         $data->nama = $request->nama;
         $data->keterangan = $request->keterngan;

         $data->save();

         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function show(penawaran_file $penawaran_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function edit(penawaran_file $penawaran_file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenawaran_fileRequest  $request
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenawaran_fileRequest $request, penawaran_file $penawaran_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(penawaran_file $penawaran_file)
    {
        //
    }
}
