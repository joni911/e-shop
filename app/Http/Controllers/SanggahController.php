<?php

namespace App\Http\Controllers;

use App\Models\sanggah;
use App\Http\Requests\StoresanggahRequest;
use App\Http\Requests\UpdatesanggahRequest;
use App\Models\peserta;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

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
        $nama_file = $this->namaFile($request);
        $user = Auth::user();
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
        $nama_file = "";

        # code...
        $tmp_file = $request->file('file');
        $file = time().".".$tmp_file->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'Tender/FILE/sanggah/'.$request->id;
        $tmp_file->move($tujuan_upload,$file);
        //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
        $nama_file=$tujuan_upload.'/'.$file;


        return $nama_file;
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
        $peserta = peserta::where('user_id',$user->id)->first();
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
