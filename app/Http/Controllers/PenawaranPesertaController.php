<?php

namespace App\Http\Controllers;

use App\Models\penawaran_peserta;
use App\Http\Requests\Storepenawaran_pesertaRequest;
use App\Http\Requests\Updatepenawaran_pesertaRequest;
use App\Models\penawaran;
use App\Models\penawaran_peserta_file;
use App\Models\tender;
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
        $data = tender::findorfail($request->id) ;
        // return
        foreach ($data->penawaran->penawaran_file as $key => $x) {
            # code...

            if (!$request->file($x->id)) {
                # code...
                return Redirect::back()->withErrors(['msg' => 'File '.$x->nama.' Tidak Boleh Kosong']);
            }
        }

        $pp = new penawaran_peserta();
        $pp->user_id = $user->id;
        $pp->tender_id = $request->id;
        $pp->peserta_id = $user->peserta->id;
        $pp->penawaran = $request->penawaran;
        $pp->koreksi = 0;
        $pp->save();


        foreach ($data->penawaran->penawaran_file as $key => $x) {
            # code...e
            if ($request->file($x->id)) {
            $tmp_file = $request->file($x->id);
            $file = time()."_".$x->nama.".".$tmp_file->getClientOriginalExtension();

      	    // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/penawaran/'.$request->id.'/'.$user->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;


                # code...
                $data = new penawaran_peserta_file();
                $data->user_id = $user->id;
                $data->penawaran_peserta_id = $pp->id;
                $data->file = $nama_file;
                $data->nama = $x->nama;
                $data->save();
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
