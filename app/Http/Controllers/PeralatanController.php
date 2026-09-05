<?php

namespace App\Http\Controllers;

use App\Models\peralatan;
use App\Http\Requests\StoreperalatanRequest;
use App\Http\Requests\UpdateperalatanRequest;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use App\Services\PesertaWizardService;
use App\Services\TenderContext;
use Illuminate\Support\Facades\Auth;

class PeralatanController extends Controller
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
     * @param  \App\Http\Requests\StoreperalatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreperalatanRequest $request)
    {
        $file = $this->peralatan_file($request);
        $user = Auth::user();
        $profil = $user->peserta;
        if ($profil && !$request->filled('id')) {
            $request->id = $profil->id;
        }
        if ($profil && !$request->filled('tender_id')) {
            $request->tender_id = TenderContext::tenderId($profil->tender_id ?? null) ?? $profil->tender_id;
        }
        $data = new peralatan();
        $data->nama = $request->nama;
        $data->tender_id = $request->tender_id;
        $data->peserta_id = $request->id;
        $data->user_id = $user->id;
        $data->jumlah = $request->jumlah;
        $data->kapasitas = $request->kapasitas;
        $data->merk = $request->merk;
        $data->tahun = $request->tahun;
        $data->kondisi = $request->kondisi;
        $data->lokasi = $request->lokasi;
        $data->kepemilikan = $request->kepemilikan;
        $data->bukti = $request->bukti;
        $data->file = $file;
        $data->save();
        return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');

    }
    public function peralatan_file($request)
    {
        # code...
        $nama_file ="";
        if ($request->file('file')) {
            $uploader = app(FileUploadService::class);
            $nama_file = $uploader->store($request->file('file'), 'Tender/peralatan/'.$request->id, 'peralatan');
        }

        return $nama_file;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 'show';
        $p = peserta::findorfail($id);
        $tenderId = TenderContext::tenderId($p->tender_id);
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = peralatan::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.peralatan.create', [
            'peralatan' => $p, 'peserta' => $p,
            'steps' => PesertaWizardService::steps($p, 'peralatan'),
            'list' => $list, 'status' => $status,
            'tenderId' => $tenderId, 'tender' => $tender,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = 'edit';
        $data = peralatan::findorfail($id);
        $p = peserta::findorfail($data->peserta_id);
        $tenderId = empty($data->tender_id) ? TenderContext::tenderId($p->tender_id) : $data->tender_id;
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = peralatan::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.peralatan.create', [
            'peralatan' => $p, 'peserta' => $p,
            'steps' => PesertaWizardService::steps($p, 'peralatan'),
            'list' => $list, 'status' => $status, 'data' => $data,
            'tenderId' => $tenderId, 'tender' => $tender,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateperalatanRequest  $request
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateperalatanRequest $request, $id)
    {
        $data = peralatan::findorfail($id);
        $file = $this->update_peralatan_file($request,$data);

        $data->nama = $request->nama;
        $data->jumlah = $request->jumlah;
        $data->kapasitas = $request->kapasitas;
        $data->merk = $request->merk;
        $data->tahun = $request->tahun;
        $data->kondisi = $request->kondisi;
        $data->lokasi = $request->lokasi;
        $data->kepemilikan = $request->kepemilikan;
        if ($request->bukti) {
            $data->bukti = $request->bukti;
        }
        if ($file) {
            $data->file = $file;
        }
        $data->save();
        return redirect()->route('peralatan.show',$data->peserta_id)->with('success','Data '.$data->nama.' telah disimpan');
    }

    public function update_peralatan_file($request,$data)
    {
        # code...
        $nama_file ="";
        if ($request->file('file')) {
            $uploader = app(FileUploadService::class);
            $uploader->delete($data->file);
            $nama_file = $uploader->store($request->file('file'), 'Tender/peralatan/'.$data->id, 'peralatan');
        }

        return $nama_file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(peralatan $peralatan)
    {
        //
    }
}
