<?php

namespace App\Http\Controllers;

use App\Models\sanggah;
use App\Http\Requests\StoresanggahRequest;
use App\Http\Requests\UpdatesanggahRequest;
use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SanggahController extends Controller
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

        return view('dashboard.sanggahan.index',['data'=>$data]);
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
     * @param  \App\Http\Requests\StoresanggahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresanggahRequest $request)
    {
        $user = Auth::user();

        // GUARD: user harus punya profil peserta & sudah terdaftar di tender ini.
        $profil = $user->peserta;
        if (!$profil || (int) $request->peserta !== (int) $profil->id) {
            return Redirect::back()->withErrors(['msg' => 'Data peserta tidak valid.']);
        }
        $daftar = daftar_peserta::where('tender_id', $request->tender)
            ->where('peserta_id', $profil->id)
            ->first();
        if (!$daftar) {
            return Redirect::back()->withErrors(['msg' => 'Anda belum terdaftar sebagai peserta tender ini. Silakan daftar terlebih dahulu sebelum mengirim sanggahan.']);
        }

        $nama_file = $this->namaFile($request);
        $data = new sanggah();
        $data->peserta_id = $request->peserta;
        $data->tender_id = $request->tender;
        $data->user_id = $user->id;
        $data->keterangan = $request->keterangan;
        $data->file = $nama_file;
        $data->save();
        return redirect()->back()->with('success','Data Berhasil disimpan');
    }

    public function namaFile($request)
    {
        // Folder memakai tender_id (bukan $request->id yang tidak dikirim form)
        if (!$request->hasFile('file')) {
            return '';
        }
        $uploader = app(FileUploadService::class);
        return $uploader->store(
            $request->file('file'),
            'Tender/FILE/sanggah/'.$request->tender,
            'sanggah'
        ) ?? '';
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = tender::findorfail($id);
        $user = Auth::user();

        // GUARD: user harus sudah terdaftar (daftar_peserta) di tender ini.
        $daftar = daftar_peserta::where('tender_id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$daftar) {
            return redirect()->route('sanggahan.index')->with('error','Anda Tidak Dapat melakukakan sanggahan karena belum ikut tender ini!');
        }

        $peserta = $daftar->peserta;
        $sanggah = sanggah::where('user_id',$user->id)->where('peserta_id',$peserta->id)->where('tender_id',$data->id)->first();
        return view('dashboard.sanggahan.pengumuman',['data'=>$data,'peserta'=>$peserta,'sanggah'=>$sanggah]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function edit(sanggah $sanggah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesanggahRequest  $request
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesanggahRequest $request, sanggah $sanggah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanggah  $sanggah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = sanggah::findorfail($id);
        $data->delete();
        return redirect()->back()->with('dangger','Data berhasil dihapus');
    }
}
