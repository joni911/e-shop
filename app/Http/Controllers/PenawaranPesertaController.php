<?php

namespace App\Http\Controllers;

use App\Models\daftar_peserta;
use App\Models\penawaran_peserta;
use App\Http\Requests\Storepenawaran_pesertaRequest;
use App\Http\Requests\Updatepenawaran_pesertaRequest;
use App\Models\penawaran;
use App\Models\penawaran_peserta_file;
use App\Models\tender;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PenawaranPesertaController extends Controller
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
     * @param  \App\Http\Requests\Storepenawaran_pesertaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenawaran_pesertaRequest $request)
    {
        //
        $user = Auth::user();

        // GUARD: user belum punya profil peserta -> arahkan lengkapi profil dulu.
        $profil = $user->peserta;
        if (!$profil) {
            return Redirect::back()->withErrors(['msg' => 'Lengkapi profil peserta terlebih dahulu sebelum mengupload penawaran.']);
        }

        $data = tender::findorfail($request->id);

        // GUARD ZONA: hanya boleh upload jika SUDAH terdaftar (daftar_peserta) utk tender ini.
        $daftar = daftar_peserta::where('tender_id', $request->id)
            ->where('peserta_id', $profil->id)
            ->first();
        if (!$daftar) {
            return Redirect::back()->withErrors(['msg' => 'Anda belum terdaftar sebagai peserta tender ini. Silakan daftar terlebih dahulu sebelum mengupload penawaran.']);
        }

        // Panitia harus menyiapkan data penawaran (judul, hps, file wajib) lebih dulu
        if (!$data->penawaran) {
            return Redirect::back()->withErrors(['msg' => 'Data penawaran untuk tender ini belum disiapkan oleh panitia.']);
        }

        // validasi file yang di upload
        foreach ($data->penawaran->penawaran_file as $key => $x) {
            # code...
            if (!$request->hasFile('file_' . $x->id)) {
                # code...
                return Redirect::back()->withErrors(['msg' => 'File '.$x->nama.' Tidak Boleh Kosong']);
            }
        }

        // 1 penawaran per (peserta, tender): jika sudah ada di tender ini, perbarui nilai + ganti file.
        $pp = penawaran_peserta::updateOrCreate(
            ['peserta_id' => $profil->id, 'tender_id' => $request->id],
            ['user_id' => $user->id, 'penawaran' => $request->penawaran, 'koreksi' => 0]
        );

        // Hapus file penawaran lama (hard delete, karena model penawaran_peserta_file memakai SoftDeletes)
        penawaran_peserta_file::where('penawaran_peserta_id', $pp->id)->forceDelete();

        $uploader = app(FileUploadService::class);
        foreach ($data->penawaran->penawaran_file as $key => $x) {
            # code...e
            if ($request->hasFile('file_' . $x->id)) {
                $relativeDir = 'Tender/penawaran/'.$request->id.'/'.$user->id;
                $nama_file = $uploader->store(
                    $request->file('file_' . $x->id),
                    $relativeDir,
                    $x->nama
                );

                # code...
                $fileRec = new penawaran_peserta_file();
                $fileRec->user_id = $user->id;
                $fileRec->penawaran_peserta_id = $pp->id;
                $fileRec->file = $nama_file;
                $fileRec->nama = $x->nama;
                $fileRec->save();
            }

        }

        return redirect()->back()->with('success','Data telah disimpan');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function show(penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenawaran_pesertaRequest  $request
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenawaran_pesertaRequest $request, penawaran_peserta $penawaran_peserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penawaran_peserta  $penawaran_peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(penawaran_peserta $penawaran_peserta)
    {
        //
    }
}
