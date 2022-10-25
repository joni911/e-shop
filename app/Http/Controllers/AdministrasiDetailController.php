<?php

namespace App\Http\Controllers;

use App\Models\administrasi_detail;
use App\Http\Requests\Storeadministrasi_detailRequest;
use App\Http\Requests\Updateadministrasi_detailRequest;
use App\Models\administrasi;
use App\Models\peserta;
use App\Models\tender;
use Illuminate\Support\Facades\Auth;

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
        $admin = administrasi::where('tender_id',$tid)->get();
        $user = Auth::user();
        foreach ($admin as $key => $a) {
            $x = $a->id;
            $tender_id = "1".$x;
            $nama_n = "2".$x;
            $admin_id = "3".$x;
            $request->$tender_id;
            if ($request->$x) {

            $tmp_file = $request->file($x);
            $file = time()."-".$x.".".$tmp_file->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/administrasi/'.$p.'/'.$a->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat link
            $nama_file=$tujuan_upload.'/'.$file;

                $ad = new administrasi_detail();
                $ad->user_id = $user->id;
                $ad->tender_id = $request->$tender_id;
                $ad->nama = $request->$nama_n;
                $ad->administrasi_id = $request->$admin_id;
                $ad->peserta_id = $p;
                $ad->file = $nama_file;
                $ad->save();
                # code...
                //id 	tender_file_id 	user_id 	files 	keterangan 	created_at 	updated_at 	deleted_at
                // $tfs = administrasi_detail::findorfail($x);
                // echo $tfs;
                // $tfs->files = $nama_file;
                // $tfs->save();
                // return $tfs;

            }


        }
        return redirect()->back();
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
        $peserta= peserta::findorfail($id);
        $tid = $peserta->tender_id;
        $tender = tender::findorfail($tid);
        $admin = administrasi::where('tender_id',$tid)->get();

        $list = administrasi_detail::where('peserta_id',$id)->where('tender_id',$tid)->get();
        // if ($list->isEmpty()) {
        //     # code...
        //     return "null";
        // }
        return view('tender_user.peserta.administrasi.detail.index',['data'=>$tender,'admin'=>$admin,'peserta'=>$peserta,'list'=>$list]);

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
