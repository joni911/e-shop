<?php

namespace App\Http\Controllers;

use App\Models\pengalaman_tender;
use App\Http\Requests\Storepengalaman_tenderRequest;
use App\Http\Requests\Updatepengalaman_tenderRequest;
use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use App\Services\TenderContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PengalamanTenderController extends Controller
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
        return 'pengalaman tender';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storepengalaman_tenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepengalaman_tenderRequest $request)
    {
        $user = Auth::user();

        // LOG ANALISA: snapshot input yang dikirim form saat submit.
        Log::info('[PENGALAMAN-STORE] ENTRY', [
            'user_id'       => $user->id ?? null,
            'user_email'    => $user->email ?? null,
            'method'        => $request->method(),
            'url'           => $request->fullUrl(),
            'posted_id'     => $request->input('id'),
            'posted_tender_id' => $request->input('tender_id'),
            'has_file1'     => $request->hasFile('file1'),
            'input_all'     => $request->except(['_token', '_method']),
        ]);

        // GUARD: user harus punya profil peserta & sudah terdaftar di tender ini.
        $profil = $user->peserta;

        // FALLBACK (uji di controller): form Tambah belum mengirim hidden id/tender_id → ambil dari profil peserta login.
        if ($profil && !$request->filled('id')) {
            $request->id = $profil->id;
        }
        if ($profil && !$request->filled('tender_id')) {
            // Prioritas: tender konteks wizard → fallback tender milik profil.
            $request->tender_id = TenderContext::tenderId($profil->tender_id ?? null) ?? $profil->tender_id;
        }

        // LOG ANALISA: profil peserta milik user login (pembanding guard id).
        Log::info('[PENGALAMAN-STORE] GUARD-1 (id peserta)', [
            'user_id'              => $user->id ?? null,
            'peserta_id_login'     => $profil->id ?? null,
            'peserta_tender_login' => $profil->tender_id ?? null,
            'posted_id'            => $request->input('id'),
            'match'                => $profil && ((int) $request->input('id') === (int) $profil->id),
        ]);

        if (!$profil || (int) $request->id !== (int) $profil->id) {
            Log::warning('[PENGALAMAN-STORE] GAGAL Guard-1: Data peserta tidak valid', [
                'user_id' => $user->id ?? null,
                'posted_id' => $request->input('id'),
                'peserta_id_login' => $profil->id ?? null,
            ]);
            return Redirect::back()->withErrors(['msg' => 'Data peserta tidak valid.']);
        }

        $daftar = daftar_peserta::where('tender_id', $request->tender_id)
            ->where('peserta_id', $profil->id)
            ->first();

        // LOG ANALISA: hasil cek pendaftaran user di tender target (guard 2).
        Log::info('[PENGALAMAN-STORE] GUARD-2 (terdaftar di tender?)', [
            'user_id'            => $user->id ?? null,
            'peserta_id'         => $profil->id,
            'posted_tender_id'   => $request->input('tender_id'),
            'terdaftar_ditemukan' => $daftar ? $daftar->id : null,
        ]);

        if (!$daftar) {
            Log::warning('[PENGALAMAN-STORE] GAGAL Guard-2: belum terdaftar di tender', [
                'user_id' => $user->id ?? null,
                'peserta_id' => $profil->id,
                'posted_tender_id' => $request->input('tender_id'),
            ]);
            return Redirect::back()->withErrors(['msg' => 'Anda belum terdaftar sebagai peserta tender ini. Silakan daftar terlebih dahulu.']);
        }

        $file = $this->pengalaman_file($request);
        $data = new pengalaman_tender();
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->user_id = $user->id;
        $data->lokasi = $request->lokasi;
        $data->instansi = $request->instansi;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_kontrak = $request->no_kontrak;
        $data->tgl_kontrak = $request->tgl_kontrak;
        $data->presentasi = $request->presentasi;
        $data->tgl_selesai_kontrak = $request->tgl_selesai_kontrak;
        $data->tgl_serah_terima = $request->tgl_serah_terima;
        $data->keterangan = $request->keterangan;
        $data->pekerjaan = $request->pekerjaan;
        $data->nilai_kontrak = $request->nilai_kontrak;
        $data->file = $file;
        $data->nama_file = $request->nama_file;
        $data->save();

        Log::info('[PENGALAMAN-STORE] BERHASIL disimpan', [
            'user_id'     => $user->id ?? null,
            'peserta_id'  => $request->input('id'),
            'tender_id'   => $request->input('tender_id'),
            'pengalaman_id' => $data->id,
            'file'        => $file,
        ]);

        return redirect()->back()->with('success','Data '.$data->pekerjaan.' telah disimpan');
    }

    public function pengalaman_file($request)
    {
        # code...
        $nama_file ="";
        if ($request->file('file1')) {
            $uploader = app(FileUploadService::class);
            $nama_file = $uploader->store($request->file('file1'), 'Tender/pengalaman/'.$request->id, 'pengalaman');
        }

        return $nama_file;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengalaman_tender  $pengalaman_tender
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = peserta::findorfail($id);
        $tenderId = TenderContext::tenderId($p->tender_id);
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = pengalaman_tender::where('peserta_id', $p->id)
            ->where('tender_id', $tenderId)
            ->paginate(10);
        return view('tender_user.peserta.pengalaman.show', [
            'peserta' => $p,
            'list'    => $list,
            'tender'  => $tender,
            'tenderId'=> $tenderId,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengalaman_tender  $pengalaman_tender
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = pengalaman_tender::findorfail($id);
        $p = peserta::findorfail($data->peserta_id);
        $tenderId = empty($data->tender_id) ? TenderContext::tenderId($p->tender_id) : $data->tender_id;
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = pengalaman_tender::where('peserta_id', $p->id)
            ->where('tender_id', $tenderId)
            ->paginate(10);
        return view('tender_user.peserta.pengalaman.edit', [
            'peserta' => $p,
            'list'    => $list,
            'data'    => $data,
            'tender'  => $tender,
            'tenderId'=> $tenderId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepengalaman_tenderRequest  $request
     * @param  \App\Models\pengalaman_tender  $pengalaman_tender
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepengalaman_tenderRequest $request, $id)
    {
        //
        // $user = Auth::user();
        // $data = new pengalaman_tender();
        $data = pengalaman_tender::findorfail($id);
        $file = $this->update_pengalaman_file($request,$data);
        // $data->peserta_id = $request->id;
        // $data->tender_id = $request->tender_id;
        // $data->user_id = $user->id;


        $data->lokasi = $request->lokasi;
        $data->instansi = $request->instansi;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_kontrak = $request->no_kontrak;
        $data->tgl_kontrak = $request->tgl_kontrak;
        $data->presentasi = $request->presentasi;
        $data->tgl_selesai_kontrak = $request->tgl_selesai_kontrak;
        $data->tgl_serah_terima = $request->tgl_serah_terima;
        $data->keterangan = $request->keterangan;
        $data->pekerjaan = $request->pekerjaan;
        $data->nilai_kontrak = $request->nilai_kontrak;
        $data->file = $file;
        $data->nama_file = $request->nama_file;
        $data->save();

        return redirect()->route('pengalaman.show',$data->peserta_id)->with('success','Data '.$data->pekerjaan.' telah dirubah');
    }

    public function update_pengalaman_file($request,$data)
    {
        # code...
        $nama_file ="";
        if ($request->file('file1')) {
            $uploader = app(FileUploadService::class);
            // Hapus file lama
            $uploader->delete($data->file);
            $nama_file = $uploader->store($request->file('file1'), 'Tender/pengalaman/'.$data->id, 'pengalaman');
        }

        return $nama_file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengalaman_tender  $pengalaman_tender
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
