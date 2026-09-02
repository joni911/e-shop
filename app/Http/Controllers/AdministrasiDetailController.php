<?php

namespace App\Http\Controllers;

use App\Models\administrasi_detail;
use App\Http\Requests\Storeadministrasi_detailRequest;
use App\Http\Requests\Updateadministrasi_detailRequest;
use App\Models\administrasi;
use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use App\Services\TenderContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdministrasiDetailController extends Controller
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
     * @param  \App\Http\Requests\Storeadministrasi_detailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeadministrasi_detailRequest $request)
    {
        $tid = $request->default;
        $p = $request->peserta;
        $user = Auth::user();

        // GUARD: user harus punya profil peserta & sudah terdaftar di tender ini.
        $profil = $user->peserta;
        if (!$profil || (int) $p !== (int) $profil->id) {
            return Redirect::back()->withErrors(['msg' => 'Data peserta tidak valid.']);
        }
        $daftar = daftar_peserta::where('tender_id', $tid)
            ->where('peserta_id', $profil->id)
            ->first();
        if (!$daftar) {
            return Redirect::back()->withErrors(['msg' => 'Anda belum terdaftar sebagai peserta tender ini. Silakan daftar terlebih dahulu sebelum mengupload berkas administrasi.']);
        }

        $admin = administrasi::where('tender_id',$tid)->get();
        $uploader = app(FileUploadService::class);
        foreach ($admin as $key => $a) {
            $x = $a->id;
            $tender_id = "1".$x;
            $nama_n = "2".$x;
            $admin_id = "3".$x;
            $request->$tender_id;
            if ($request->hasFile($x)) {

                $relativeDir = 'Tender/administrasi/'.$p.'/'.$a->id;
                $nama_file = $uploader->store($request->file($x), $relativeDir, $a->nama);

                $ad = new administrasi_detail();
                $ad->user_id = $user->id;
                $ad->tender_id = $request->$tender_id;
                $ad->nama = $request->$nama_n;
                $ad->administrasi_id = $request->$admin_id;
                $ad->peserta_id = $p;
                $ad->file = $nama_file;
                $ad->save();
                # code...
            }


        }
        return redirect()->back()->with('success','Berkas administrasi berhasil diupload.');
    }

    public function upfile($request)
    {
        # code...
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\administrasi_detail  $administrasi_detail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = peserta::findorfail($id);
        // Konteks wizard (bila dipilih) menentukan tender aktif, bukan selalu $peserta->tender_id.
        $tenderId = TenderContext::tenderId($peserta->tender_id ?? null) ?? $peserta->tender_id;
        $tender = tender::findorfail($tenderId);
        $admin = administrasi::where('tender_id', $tenderId)->get();
        $list = administrasi_detail::where('peserta_id', $id)->where('tender_id', $tenderId)->get();

        return view('tender_user.peserta.administrasi.detail.index', [
            'data' => $tender, 'admin' => $admin, 'peserta' => $peserta, 'list' => $list,
            'tender' => $tender, 'tenderId' => $tenderId,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\administrasi_detail  $administrasi_detail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateadministrasi_detailRequest  $request
     * @param  \App\Models\administrasi_detail  $administrasi_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Updateadministrasi_detailRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\administrasi_detail  $administrasi_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = administrasi_detail::where('peserta_id',$id)->get();
        foreach ($data as $key => $ad) {
            $ad->delete();
        }
        return redirect()->back();

    }
}
