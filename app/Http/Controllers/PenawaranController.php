<?php

namespace App\Http\Controllers;

use App\Models\penawaran;
use App\Http\Requests\StorepenawaranRequest;
use App\Http\Requests\UpdatepenawaranRequest;
use App\Models\tender;
use App\Models\tender_persyaratan;
use Illuminate\Support\Facades\Auth;

class PenawaranController extends Controller
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
     * @param  \App\Http\Requests\StorepenawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepenawaranRequest $request)
    {
        $user = Auth::user();

        $data = new penawaran();
        $data->judul = $request->judul;
        $data->user_id = $user->id;
        $data->tender_id = $request->id;
        $data->anggaran = $request->anggaran;
        $data->hps = $request->hps;
        $data->penjelasan = $request->penjelasan;

        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tender = tender::findorfail($id);

        $penawaran = $tender->penawaran;

        return view('tender_admin.penawaran.create',['tender'=>$tender,'penawaran'=>$penawaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $data = tender::findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepenawaranRequest  $request
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepenawaranRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
