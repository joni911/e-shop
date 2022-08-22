<?php

namespace App\Http\Controllers;

use App\Models\tender_persyaratan_file;
use App\Http\Requests\Storetender_persyaratan_fileRequest;
use App\Http\Requests\Updatetender_persyaratan_fileRequest;
use Illuminate\Support\Facades\Auth;

class TenderPersyaratanFileController extends Controller
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
     * @param  \App\Http\Requests\Storetender_persyaratan_fileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetender_persyaratan_fileRequest $request)
    {

        $user = Auth::user();


            $tmp_file = $request->file;
            $file = time()."_".$request->nama.".".$tmp_file->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/Persyaratan/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        $data = new tender_persyaratan_file();
        $data->user_id = $user->id;
        $data->tender_persyaratan_id = $request->id;
        $data->nama = $request->nama;
        $data->file = $nama_file;

        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tender_persyaratan_file  $tender_persyaratan_file
     * @return \Illuminate\Http\Response
     */
    public function show(tender_persyaratan_file $tender_persyaratan_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tender_persyaratan_file  $tender_persyaratan_file
     * @return \Illuminate\Http\Response
     */
    public function edit(tender_persyaratan_file $tender_persyaratan_file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetender_persyaratan_fileRequest  $request
     * @param  \App\Models\tender_persyaratan_file  $tender_persyaratan_file
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetender_persyaratan_fileRequest $request, tender_persyaratan_file $tender_persyaratan_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tender_persyaratan_file  $tender_persyaratan_file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tender_persyaratan_file::findorfail($id);
        $data->delete();

        return redirect()->back();
    }
}
