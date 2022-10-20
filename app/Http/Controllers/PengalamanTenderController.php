<?php

namespace App\Http\Controllers;

use App\Models\pengalaman_tender;
use App\Http\Requests\Storepengalaman_tenderRequest;
use App\Http\Requests\Updatepengalaman_tenderRequest;
use App\Models\peserta;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

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

        $file = $this->pengalaman_file($request);
        $user = Auth::user();
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

        return redirect()->back()->with('success','Data '.$data->pekerjaan.' telah disimpan');
    }

    public function pengalaman_file($request)
    {
        # code...
        $nama_file ="";
        if ($request->file()) {
            # code...
             $tmp_file = $request->file('file1');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/pengalaman/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
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
        $status = 'show';
        $p = peserta::findorfail($id);
        $list = pengalaman_tender::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.pengalaman.create',['peserta'=>$p,'list'=>$list,'status'=>$status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengalaman_tender  $pengalaman_tender
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = 'edit';
        $data = pengalaman_tender::findorfail($id);
        $p = peserta::findorfail($data->peserta_id);
        $list = pengalaman_tender::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.pengalaman.create',['peserta'=>$p,'list'=>$list,'data'=>$data,'status'=>$status]);
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
        if ($request->file()) {
            # code...
             $tmp_file = $request->file('file1');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/pengalaman/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
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
