<?php

namespace App\Http\Controllers;

use App\Models\jenis_kontrak;
use App\Models\jenis_pengadaan;
use App\Models\metode_pengadaan;
use App\Models\status_tender;
use App\Models\tender;
use Illuminate\Http\Request;

class tenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = tender::paginate(10);

        return view('tender.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jk = jenis_kontrak::get();
        $jp = jenis_pengadaan::get();
        $mp = metode_pengadaan::get();
        $st = status_tender::get();
        return view('tender.create',
        [
            'kontrak'=>$jk,
            'pengadaan'=>$jp,
            'metode'=>$mp,
            'status'=>$st
        ]);

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
        $this->validate($request, [
			'nama' => 'required',
            'jk' => 'required',
            'jp'  => 'required',
            'mp' => 'required',
            'klpd' => 'required',
            'lokasi' => 'required',
            'dana' => 'required',
            'satuan_kerja' => 'required',
            'tanggal' => 'required',
            'nilai' => 'required',
            'hps' => 'required',
            'status' => 'required',
		]);

        $data = new tender();
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('tender.index');
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
        $data = tender::findorfail($id);

        return view('tender.edit',['data'=>$data]);
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
         $this->validate($request, [
			'nama' => 'required'
		]);

        $data = tender::findorfail($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('tender.index');
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
        $data = tender::findorfail($id);
        $data->delete();

        return redirect()->back();
    }
}
