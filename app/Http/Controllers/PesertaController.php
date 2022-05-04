<?php

namespace App\Http\Controllers;

use App\Http\Requests\pesertaRequest;
use App\Models\peserta;
use App\Models\tender;
use App\Models\tender_file_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PesertaController extends Controller
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
        return 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(pesertaRequest $request)
    {
        //
        $user = Auth::user();
        $file = tender::findorfail($request->id);
        //validasi file yang di upload
        foreach ($file->tender_file as $key => $tc) {
            # code...
            $x = $tc->id;
            if (!$request->$x) {
                # code...
                return Redirect::back()->withErrors(['msg' => 'File '.$tc->nama.' Tidak Boleh Kosong']);
            }
        }
        //save file

        $data = new peserta();
        $data->tender_id = $request->id;
        $data->nama_perusahaan = $request->nama_pt;
        $data->NPWP = $request->NPWP;
        $data->no_hp = $request->no_hp;
        $data->alamat = $request->alamat;
        $data->penawaran = $request->penawaran;
        $data->harga_koreksi = 0;
        $data->user_id = $user->id;
        $data->save();

        //upload file setelah falidasi
        foreach ($file->tender_file as $key => $ts) {
            # code...
            $x = $ts->id;
            $tmp_file = $request->file($x);
            $file = time()."_".$tmp_file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id.'/'.$ts->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
            if ($request->$x) {
                # code...
                //id 	tender_file_id 	user_id 	files 	keterangan 	created_at 	updated_at 	deleted_at
                $tfs = new tender_file_detail();
                $tfs->tender_file_id = $x;
                $tfs->user_id = $user->id;
                $tfs->files = $nama_file;
                $tfs->keterangan = "";
                $tfs->peserta_id = $data->id;
                $tfs->tender_id = $request->id;
                $tfs->save();
            }
        }

        return redirect()->route('tender_home.show',$request->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function getPeserta($user,$id)
    {
        return $peserta = peserta::where('user_id',$user->id)
        ->where('tender_id',$id)
        ->first();
    }
    public function show($id)
    {

        $user = Auth::user();
        $peserta = $this->getPeserta($user,$id);
        if (is_null($peserta)) {
            # code...
            $data = tender::join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
            ->join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
            ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
            ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
            ->select('tenders.*','jenis_pengadaans.nama as jpn','jenis_kontraks.nama as jkn',
            'metode_pengadaans.nama as mpn','status_tenders.nama as stn')
            ->findorfail($id);

            // $now = Carbon::now();
            return view('tender_user.peserta.create',['data'=>$data]);
        }
        return redirect()->route('peserta.file',['id'=>$id,'pid'=>$peserta->id]);

    }
    public function show_peserta($id)
    {
        //
        $data = tender::findorfail($id);
        $peserta = peserta::join('tenders','tenders.id','pesertas.tender_id')
        // ->join('tender_files','tender_files.tender_id','tenders.id')
        // ->join('tender_file_details','tender_file_details.tender_file_id','tender_files.id')
        ->where('tenders.id',$id)
        ->select('pesertas.*')
        // ->groupBy('id')
        ->paginate(10);
        return view('tender_user.peserta.show',['data'=>$data,'peserta'=>$peserta]);
    }

    public function show_file_peserta($id,$pid)
    {
        // $p = $
        $data = peserta::join('tenders','tenders.id','pesertas.tender_id')
        ->select('pesertas.*','tenders.nama as nama_tender')
        ->findorfail($pid)
        ;
        $file = tender_file_detail::join('pesertas','pesertas.id','tender_file_details.peserta_id')
        ->join('tender_files','tender_files.id','tender_file_details.tender_file_id')
        ->join('tenders','tenders.id','tender_files.tender_id')
        ->where('pesertas.id',$pid)
        ->where('tenders.id',$id)
        ->select('tender_file_details.id as id','tender_files.nama as nama_file'
        ,'tender_file_details.files as file')
        ->get();

        return view('tender_user.peserta.files.show',['data'=>$data,'file'=>$file]);


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
