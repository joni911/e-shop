<?php

namespace App\Http\Controllers;

use App\Http\Requests\pesertaRequest;
use App\Models\peserta;
use App\Models\tender;
use App\Models\tender_file_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PesertaController extends Controller
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
        return 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(pesertaRequest $request)
    {
        //
        $user = Auth::user();
        $file = tender::findorfail($request->id);
        //validasi file
        foreach ($file->tender_file as $key => $tc) {
            # code...
            $x = $tc->id;
            if (!$request->$x) {
                # code...
                return Redirect::back()->withErrors(['msg' => 'File '.$tc->nama.' Tidak Boleh Kosong']);
            }
        }
        //save file
        foreach ($file->tender_file as $key => $ts) {
            # code...
            $x = $ts->id;
            $tmp_file = $request->file($x);
            $nama_file = time()."_".$tmp_file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id.'/'.$ts->id;
            $tmp_file->move($tujuan_upload,$nama_file);
            if ($request->$x) {
                # code...
                //id 	tender_file_id 	user_id 	files 	keterangan 	created_at 	updated_at 	deleted_at
                $tfs = new tender_file_detail();
                $tfs->tender_file_id = $x;
                $tfs->user_id = $user->id;
                $tfs->files = $nama_file;
            }
        }
        $data = new peserta();
        $data->tender_id = $request->id;
        $data->nama_perusahaan = $request->nama_pt;
        $data->NPWP = $request->NPWP;
        $data->no_hp = $request->no_hp;
        $data->alamat = $request->alamat;
        $data->penawaran = $request->penawaran;
        $data->harga_koreksi = 0;
        $data->user_id = $user->id;
        $data->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = tender::join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
        ->join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
        ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
        ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
        ->select('tenders.*','jenis_pengadaans.nama as jpn','jenis_kontraks.nama as jkn',
        'metode_pengadaans.nama as mpn','status_tenders.nama as stn')
        ->findorfail($id);

        // $now = Carbon::now();
        return view('tender_user.peserta.create',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peserta  $peserta
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
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
