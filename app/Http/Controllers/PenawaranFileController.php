<?php

namespace App\Http\Controllers;

use App\Models\penawaran_file;
use App\Http\Requests\Storepenawaran_fileRequest;
use App\Http\Requests\Updatepenawaran_fileRequest;
use App\Models\penawaran;
use App\Models\penawaran_peserta;
use App\Models\penawaran_peserta_file;
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
        return 'index';
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

         return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return $id;
        $tender = tender::findorfail($id);
        $data = penawaran::where('tender_id',$id)->first();
        $user = Auth::user();
        $pp = penawaran_peserta::
        where('peserta_id',$user->peserta->id)
        ->where('tender_id',$tender->id)
        ->first()
        ;
        // dd($pp->penawaran_peserta_file);

        return view('tender_admin.penawaran.show',['tender'=>$tender,'data'=>$data,'pp'=>$pp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Updatepenawaran_fileRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran_file  $penawaran_file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
