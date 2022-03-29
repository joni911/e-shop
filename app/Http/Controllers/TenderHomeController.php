<?php

namespace App\Http\Controllers;

use App\Models\tender;
use Illuminate\Http\Request;

class TenderHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = tender::join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
        ->join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
        ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
        ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
        ->select('tenders.*','jenis_pengadaans.nama as jpn','jenis_kontraks.nama as jkn',
        'metode_pengadaans.nama as mpn','status_tenders.nama as stn')
        ->paginate(10);
        // return $data;
        return view('tender.home.home',['data'=>$data]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}