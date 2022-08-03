<?php

namespace App\Http\Controllers;

use App\Models\validasi_file;
use App\Http\Requests\Storevalidasi_fileRequest;
use App\Http\Requests\Updatevalidasi_fileRequest;
use Illuminate\Support\Facades\Auth;

class ValidasiFileController extends Controller
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
     * @param  \App\Http\Requests\Storevalidasi_fileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storevalidasi_fileRequest $request)
    {
        $user = Auth::user();
        $data = new validasi_file();
        $data->tender_file_detail_id = $request->id;
        $data->user_id = $user->id;
        $data->status = $request->status;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->back()->with('success','Data telah disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\validasi_file  $validasi_file
     * @return \Illuminate\Http\Response
     */
    public function show(validasi_file $validasi_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\validasi_file  $validasi_file
     * @return \Illuminate\Http\Response
     */
    public function edit(validasi_file $validasi_file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatevalidasi_fileRequest  $request
     * @param  \App\Models\validasi_file  $validasi_file
     * @return \Illuminate\Http\Response
     */
    public function update(Updatevalidasi_fileRequest $request, validasi_file $validasi_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\validasi_file  $validasi_file
     * @return \Illuminate\Http\Response
     */
    public function destroy(validasi_file $validasi_file)
    {
        //
    }
}
