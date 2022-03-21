<?php

namespace App\Http\Controllers;

use App\Models\perubahan;
use App\Models\tahapan;
use App\Models\tender;
use Illuminate\Http\Request;

class PerubahanController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\perubahan  $perubahan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = perubahan::join('tahapans','tahapans.id','perubahans.tahapan_id')
        ->join('tenders','tenders.id','tahapans.tender_id')
        ->where('tahapans.id',$id)
        ->select(
            // 'tahapans.akhir as ta','tahapans.mulai as tm','tahapans.keterangan as tk',
            'perubahans.*','tenders.nama as nama'
            )
        ->paginate(10)
        ;
        $tahapan = tahapan::findorfail($id);

        return view('perubahan.index',["data"=>$data,'tahapan'=>$tahapan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\perubahan  $perubahan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\perubahan  $perubahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\perubahan  $perubahan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
