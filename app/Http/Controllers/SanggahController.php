<?php

namespace App\Http\Controllers;

use App\Models\sanggah;
use App\Http\Requests\StoresanggahRequest;
use App\Http\Requests\UpdatesanggahRequest;
use App\Models\peserta;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

class SanggahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = tender::where('default',0)->paginate(10);
        // return $data = tender_file::get();

        return view('dashboard.sanggahan.index',['data'=>$data]);
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
     * @param  \App\Http\Requests\StoresanggahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresanggahRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = tender::findorfail($id);
        $user = Auth::user();
        $peserta = peserta::where('user_id',$user->id)->first();
        return view('dashboard.sanggahan.pengumuman',['data'=>$data,'peserta'=>$peserta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function edit(sanggah $sanggah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesanggahRequest  $request
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesanggahRequest $request, sanggah $sanggah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function destroy(sanggah $sanggah)
    {
        //
    }
}
