<?php

namespace App\Http\Controllers;

use App\Models\tender_persyaratan;
use App\Http\Requests\Storetender_persyaratanRequest;
use App\Http\Requests\Updatetender_persyaratanRequest;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

class TenderPersyaratanController extends Controller
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
     * @param  \App\Http\Requests\Storetender_persyaratanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetender_persyaratanRequest $request)
    {
        //
        $user = Auth::user();

        $data = new tender_persyaratan();
        $data->user_id = $user->id;
        $data->tender_id = $request->id;
        $data->judul = $request->nama;
        $data->penjelasan = $request->content;

        $data->save();
        return redirect()->route('tender_persyarat.edit',[$data->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tender_persyaratan  $tender_persyaratan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Auth::user();
        $tender = tender::findorfail($id);
        $persyaratan = $tender->tender_persyaratan;


        return view('tender_admin.tender_syarat.create',
        [
            'tender' => $tender,
            'persyaratan' => $persyaratan,
            'admin' =>$admin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tender_persyaratan  $tender_persyaratan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $admin = Auth::user();

        $persyaratan = tender_persyaratan::findorfail($id);

        $tender = $persyaratan->tender;


        return view('tender_admin.tender_syarat.create',
        [
            'tender' => $tender,
            'persyaratan' => $persyaratan,
            'admin' =>$admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetender_persyaratanRequest  $request
     * @param  \App\Models\tender_persyaratan  $tender_persyaratan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetender_persyaratanRequest $request, $id)
    {
        //
        $data =  tender_persyaratan::findorfail($id);
        $data->judul = $request->nama;
        $data->penjelasan = $request->content;

        $data->save();
        return redirect()->route('tender_persyarat.edit',[$data->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tender_persyaratan  $tender_persyaratan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
