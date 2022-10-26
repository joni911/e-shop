<?php

namespace App\Http\Controllers;

use App\Models\file_teknis;
use App\Http\Requests\Storefile_teknisRequest;
use App\Http\Requests\Updatefile_teknisRequest;
use App\Models\administrasi;
use App\Models\administrasi_detail;
use App\Models\peserta;
use App\Models\tender;
use App\Models\tender_file;
use Illuminate\Support\Facades\Auth;

class FileTeknisController extends Controller
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
     * @param  \App\Http\Requests\Storefile_teknisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storefile_teknisRequest $request)
    {
            // return $request;
            $tid = $request->tender_id;
            $pid = $request->peserta;
            $user = Auth::user();

            $smkk = $this->fsmkk($request);
            $komitmen = $this->fkomit($request);

            $data = new file_teknis();
            $data->user_id = $user->id;
            $data->peserta_id = $pid;
            $data->tender_id = $tid;
            $data->smkk = $smkk;
            $data->komitmen = $komitmen;
            $data->save();

            return redirect()->back();

    }

    public function fsmkk($request)
    {
        # code...
            $tid = $request->tender_id;
            $pid = $request->peserta;
            $tmp_smkk = $request->file('smkk');
            $file_smkk = "smkk - ".time().".".$tmp_smkk->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload_smkk = 'Tender/administrasi/'.$tid.'/'.$pid;
            $tmp_smkk->move($tujuan_upload_smkk,$file_smkk);
            //nama file dan tujuan di jadikan satu agar mudah di buat link
            $smkk=$tujuan_upload_smkk.'/'.$file_smkk;

            return $smkk;
    }

    public function fkomit($request)
    {
        # code...
            $tid = $request->tender_id;
            $pid = $request->peserta;


            $tmp_file_komitmen = $request->file('komitmen');
            $file_komitmen = "komitmen - ".time().".".$tmp_file_komitmen->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload_komitmen = 'Tender/administrasi/'.$tid.'/'.$pid;
            $tmp_file_komitmen->move($tujuan_upload_komitmen,$file_komitmen);
            //nama file dan tujuan di jadikan satu agar mudah di buat link
            $komitmen=$tujuan_upload_komitmen.'/'.$file_komitmen;
            return $komitmen;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\file_teknis  $file_teknis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta= peserta::findorfail($id);
        $tid = $peserta->tender_id;
        $tender = tender::findorfail($tid);
        // $admin = administrasi::where('tender_id',$tid)->get();

        $list = file_teknis::where('peserta_id',$id)->where('tender_id',$tid)->first();

        return view('tender_user.peserta.administrasi.rkk.index',['data'=>$tender,'peserta'=>$peserta,'list'=>$list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\file_teknis  $file_teknis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatefile_teknisRequest  $request
     * @param  \App\Models\file_teknis  $file_teknis
     * @return \Illuminate\Http\Response
     */
    public function update(Updatefile_teknisRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\file_teknis  $file_teknis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = file_teknis::findorfail($id);
        $data->delete();
        return redirect()->back();

    }
}
