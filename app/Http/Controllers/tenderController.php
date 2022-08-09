<?php

namespace App\Http\Controllers;

use App\Http\Requests\tenderRequest;
use App\Models\jenis_kontrak;
use App\Models\jenis_pengadaan;
use App\Models\metode_pengadaan;
use App\Models\status_tender;
use App\Models\syarat;
use App\Models\tahapan;
use App\Models\tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('tender_admin.index',['data'=>$data]);
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
        return view('tender_admin.create',
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
    public function store(tenderRequest $request)
    {
        $user = Auth::user();
        $data = new tender();
        $data->user_id = $user->id;
        $data->nama = $request->nama;
        $data->tahapan_id = 0;
        $data->jenis_pegadaan_id = $request->jp;
        $data->jenis_kontrak_id = $request->jk;
        $data->metode_pengadaan_id = $request->mp;
        $data->syarat_id = 0;
        $data->status_tender_id = $request->status;
        $data->KLPD = $request->klpd;
        $data->sumber_dana = $request->dana;
        $data->satuan_kerja = $request->satuan_kerja;
        $data->tahun_anggaran = $request->tanggal;
        $data->lokasi_pekerjaan = $request->lokasi;
        $data->nilai_pagu = $request->nilai;
        $data->hps = $request->hps;
        $data->save();

        return redirect()->route('tender_admin.index');
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
    public function show_tahapan($id)
    {
        //
        $data = tender::join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
        ->join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
        ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
        ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
        ->where('tenders.id',$id)
        ->select('tenders.*', 'jenis_kontraks.nama as jkn','jenis_pengadaans.nama as jpn','metode_pengadaans.nama as mpn','status_tenders.nama as stn')
        ->first();

        $tahapan = tahapan::where('tender_id',$id)->get();

        return view('tender_admin.tahapan.create',
        [
            'data'=>$data,
            'tahapan'=>$tahapan
        ]);
    }
    public function show_syarat($id)
    {
        //
        $data = syarat::join('tenders','tenders.id','syarats.tender_id')
        ->where('tenders.id',$id)
        ->select('syarats.*', 'tenders.nama as nama_tender')
        ->get();

        $syarat = tender::findorfail($id);

        return view('tender_admin.syarat.create',
        [
            'data'=>$data,
            'syarat'=>$syarat
        ]);
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
        $data = tender::join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
        ->join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
        ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
        ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
        ->where('tenders.id',$id)
        ->select('tenders.*', 'jenis_kontraks.nama as jkn','jenis_pengadaans.nama as jpn','metode_pengadaans.nama as mpn','status_tenders.nama as stn')
        ->first();

            // return $data;

        $jk = jenis_kontrak::get();
        $jp = jenis_pengadaan::get();
        $mp = metode_pengadaan::get();
        $st = status_tender::get();

        return view('tender_admin.edit',
        [
            'kontrak'=>$jk,
            'pengadaan'=>$jp,
            'metode'=>$mp,
            'status'=>$st,
            'data'=>$data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tenderRequest $request, $id)
    {
        $data = tender::findorfail($id);
        $data->nama = $request->nama;
        $data->tahapan_id = 0;
        $data->jenis_pegadaan_id = $request->jp;
        $data->jenis_kontrak_id = $request->jk;
        $data->metode_pengadaan_id = $request->mp;
        $data->syarat_id = 0;
        $data->status_tender_id = $request->status;
        $data->KLPD = $request->klpd;
        $data->sumber_dana = $request->dana;
        $data->satuan_kerja = $request->satuan_kerja;
        $data->tahun_anggaran = $request->tanggal;
        $data->lokasi_pekerjaan = $request->lokasi;
        $data->nilai_pagu = $request->nilai;
        $data->hps = $request->hps;
        $data->save();

        return redirect()->route('tender_admin.tahapan',$data->id);
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
        return redirect()->route('tender_admin.index');
    }
}
