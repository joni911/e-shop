<?php

namespace App\Http\Controllers;

use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Models\tender_file;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return view('dashboard.index',['data'=>$data]);
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
        $data = tender::findorfail($id);
        $daftar = daftar_peserta::where('daftar_pesertas.tender_id',$id)
        ->join('pesertas','pesertas.id','daftar_pesertas.peserta_id')
        ->join('tenders','tenders.id','pesertas.tender_id')
        ->select('pesertas.*')
        ->paginate(10);

        $peserta = peserta::join('tenders','tenders.id','pesertas.tender_id')
        // ->join('pemeriksaans','pemeriksaans.peserta_id','pesertas.id')
        // ->join('tender_files','tender_files.tender_id','tenders.id')
        // ->join('tender_file_details','tender_file_details.tender_file_id','tender_files.id')
        ->where('tenders.id',$id)
        // ->where('')
        ->select('pesertas.*')
        // ->select('pesertas.*','tender_file_details.files')
        // ->groupBy('pesertas.id')
        // ->groupBy('pesertas.user_id','pesertas.id','pesertas.tender_id','pesertas.NPWP','pesertas.penawaran','pesertas.harga_koreksi','pesertas.created_at','pesertas.updated_at','pesertas.deleted_at','pesertas.nama_perusahaan')
        ->paginate(10);
        // ->get();
        return view('dashboard.peserta.show',['data'=>$data,'peserta'=>$daftar]);
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
