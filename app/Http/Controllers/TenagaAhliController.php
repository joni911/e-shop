<?php

namespace App\Http\Controllers;

use App\Models\tenaga_ahli;
use App\Http\Requests\Storetenaga_ahliRequest;
use App\Http\Requests\Updatetenaga_ahliRequest;
use App\Models\pengalaman_tender;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use App\Services\PesertaWizardService;
use App\Services\TenderContext;
use Illuminate\Support\Facades\Auth;

class TenagaAhliController extends Controller
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
     * @param  \App\Http\Requests\Storetenaga_ahliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetenaga_ahliRequest $request)
    {
        $fiile = $this->tenaga_file($request);
        $user = Auth::user();
        $this->resolveTenderContext($request, $user);
        $data = new tenaga_ahli();
        $data->user_id = $user->id;
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->nama = $request->nama;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jk = $request->jk;
        $data->alamat = $request->alamat;
        $data->negara = $request->negara;
        $data->jabatan = $request->jabatan;
        $data->pengalaman = $request->pengalaman;
        $data->email = $request->email;
        $data->keterangan = $request->keterangan;
        $data->file = $fiile;
        $data->nama_file = $request->nama_file;
        $data->save();
        return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');

    }

    public function tenaga_file($request)
    {
        # code...
        $nama_file ="";
        if ($request->file('file')) {
            $uploader = app(FileUploadService::class);
            $nama_file = $uploader->store($request->file('file'), 'Tender/tenaga_ahli/'.$request->id, 'tenaga_ahli');
        }

        return $nama_file;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tenaga_ahli  $tenaga_ahli
     * @return \Illuminate\Http\Response
     */
    /**
     * Isi peserta_id & tender_id dari konteks (session/wizard) saat form tak mengirimnya.
     */
    protected function resolveTenderContext($request, $user)
    {
        $profil = optional($user)->peserta;
        if ($profil && !$request->filled('id')) {
            $request->id = $profil->id;
        }
        if ($profil && !$request->filled('tender_id')) {
            $request->tender_id = TenderContext::tenderId($profil->tender_id ?? null) ?? $profil->tender_id;
        }
    }

    public function show($id)
    {
        $status = 'show';
        $p = peserta::findorfail($id);
        $tenderId = TenderContext::tenderId($p->tender_id);
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = tenaga_ahli::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.tenaga_ahli.create', [
            'peserta' => $p,
            'steps' => PesertaWizardService::steps($p, 'tenaga'),
            'list' => $list,
            'status' => $status,
            'tenderId' => $tenderId,
            'tender' => $tender,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tenaga_ahli  $tenaga_ahli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = 'edit';
        $data  = tenaga_ahli::findorfail($id);
        $p = peserta::findorfail($data->peserta_id);
        $tenderId = empty($data->tender_id) ? TenderContext::tenderId($p->tender_id) : $data->tender_id;
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = tenaga_ahli::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.tenaga_ahli.create', [
            'peserta' => $p,
            'list' => $list,
            'data' => $data,
            'steps' => PesertaWizardService::steps($p, 'tenaga'),
            'status' => $status,
            'tenderId' => $tenderId,
            'tender' => $tender,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetenaga_ahliRequest  $request
     * @param  \App\Models\tenaga_ahli  $tenaga_ahli
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetenaga_ahliRequest $request, $id)
    {
        $data = tenaga_ahli::findorfail($id);
        $fiile = $this->update_tenaga_file($request,$data);
        // $data = new tenaga_ahli();
        $data->nama = $request->nama;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jk = $request->jk;
        $data->alamat = $request->alamat;
        $data->negara = $request->negara;
        $data->jabatan = $request->jabatan;
        $data->pengalaman = $request->pengalaman;
        $data->email = $request->email;
        $data->keterangan = $request->keterangan;
        if ($fiile) {
            $data->file = $fiile;
        }
        if ($request->nama_file) {
            $data->nama_file =$request->nama_file;
        }
        $data->save();
        return redirect()->route('tenagaahli.show',[$data->peserta_id])->with('success','Data '.$data->nama.' telah disimpan');

    }

    public function update_tenaga_file($request,$data)
    {
        # code...
        $nama_file ="";
        if ($request->file('file')) {
            $uploader = app(FileUploadService::class);
            $uploader->delete($data->file);
            $nama_file = $uploader->store($request->file('file'), 'Tender/tenaga_ahli/'.$data->id, 'tenaga_ahli');
        }

        return $nama_file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tenaga_ahli  $tenaga_ahli
     * @return \Illuminate\Http\Response
     */
    public function destroy(tenaga_ahli $tenaga_ahli)
    {
        //
    }
}
