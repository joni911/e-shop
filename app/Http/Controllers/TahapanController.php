<?php

namespace App\Http\Controllers;

use App\Http\Requests\tahapanRequest;
use App\Http\Requests\tahapanRequestupdate;
use App\Http\Requests\tenderRequest;
use App\Models\perubahan;
use App\Models\tahapan;
use Illuminate\Http\Request;

class TahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $data = tahapan::paginate(10);

        return view('tahapan.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tahapan.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tahapanRequest $request)
    {

        $data = new tahapan();
        $data->tender_id = $request->id;
        $data->nama = $request->nama;
        $data->mulai = $request->awal;
        $data->akhir = $request->akhir;
        $data->keterangan = "";
        $data->status = $request->status;
        $data->save();

        return redirect()->back();
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
        $data = tahapan::findorfail($id);

        return view('tahapan.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tahapanRequestupdate $request, $id)
    {
        // return $request;
        $data = tahapan::findorfail($id);

        $bak = new perubahan();
        $bak->tahapan_id = $id;
        $bak->awal = $data->mulai;
        $bak->akhir = $data->akhir;
        $bak->keterangan = $data->keterangan;

        $data->nama = $request->nama;
        $data->mulai = $request->awal;
        $data->akhir = $request->akhir;
        $data->keterangan = $request->keterangan;
        $data->status = $request->status;
        $data->save();
        if ($data) {
            # code...
            $bak->save();
            return redirect()->route('tender_admin.tahapan',[$data->tender->id]);

        }else{
            return 404;
        }
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
        $data = tahapan::findorfail($id);
        $data->syarat->delete();
        $data->tahap->delete();
        $data->delete();

        return redirect()->back();
    }
}
