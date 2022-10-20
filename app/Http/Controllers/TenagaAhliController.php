<?php

namespace App\Http\Controllers;

use App\Models\tenaga_ahli;
use App\Http\Requests\Storetenaga_ahliRequest;
use App\Http\Requests\Updatetenaga_ahliRequest;
use App\Models\pengalaman_tender;
use App\Models\peserta;
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
        if ($request->file()) {
            # code...
            $tmp_file = $request->file('file');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/tenaga_ahli/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tenaga_ahli  $tenaga_ahli
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 'show';
        $p = peserta::findorfail($id);
        $list = tenaga_ahli::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.tenaga_ahli.create',['peserta'=>$p,'list'=>$list,'status'=>$status]);
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
        $list = tenaga_ahli::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.tenaga_ahli.create',['peserta'=>$p,'list'=>$list,'data'=>$data,'status'=>$status]);
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
        if ($request->file()) {
            # code...
            $tmp_file = $request->file('file');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/tenaga_ahli/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
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
