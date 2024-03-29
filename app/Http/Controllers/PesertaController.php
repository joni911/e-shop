<?php

namespace App\Http\Controllers;

use App\Http\Requests\pesertaRequest;
use App\Mail\hasil_penilaian;
use App\Models\administrasi_detail;
use App\Models\daftar_peserta;
use App\Models\file_teknis;
use App\Models\komentar;
use App\Models\pemeriksaan;
use App\Models\penawaran_peserta;
use App\Models\penilaian_administrasi;
use App\Models\penilaian_kualifikasi;
use App\Models\penilaian_penawaran_peserta;
use App\Models\penilaian_peserta;
use App\Models\penilaian_teknis;
use App\Models\peserta;
use App\Models\tender;
use App\Models\tender_file;
use App\Models\tender_file_detail;
use App\Models\tender_komen;
use App\Models\tender_status_files;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        return view('tender_user.peserta.registrasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->peserta != null) {
            return redirect()->route('peserta.edit',[$user->peserta->id]);
        }
        $default = tender::where('default',1)->first();
        $data = tender::join('jenis_pengadaans','jenis_pengadaans.id','tenders.jenis_pegadaan_id')
            ->join('jenis_kontraks','jenis_kontraks.id','tenders.jenis_kontrak_id')
            ->join('metode_pengadaans','metode_pengadaans.id','tenders.metode_pengadaan_id')
            ->join('status_tenders','status_tenders.id','tenders.status_tender_id')
            ->select('tenders.*','jenis_pengadaans.nama as jpn','jenis_kontraks.nama as jkn',
            'metode_pengadaans.nama as mpn','status_tenders.nama as stn')
            ->findorfail($default->id);
            $file = tender_file::where('tender_id',$default->id)->get();
            // $now = Carbon::now();
        return view('tender_user.peserta.registrasi.create',['data'=>$data, 'file'=>$file]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(pesertaRequest $request)
    {
        // return redirect()->route('pengalaman.create');
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
        $data->nama_pt = $request->nama_pt;
        // $data->NPWP = $request->NPWP;
        $data->NPWP = "";
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->izin = $request->izin;
        $data->nomor_izin = $request->nomor_izin;
        $data->izin_berlaku = $request->izin_berlaku;
        $data->instansi_pemberi = $request->instansi_pemberi;
        $data->kualifikasi = $request->kualifikasi;
        $data->klasifikasi = $request->klasifikasi;
        $data->no_akta = $request->no_akta;
        $data->tgl_akta = $request->tgl_akta;
        $data->notaris = $request->notaris;
        $data->no_aktab = $request->no_aktab;
        $data->tgl_aktab = $request->tgl_aktab;
        $data->notaris_b = $request->notaris_b;
        // $data->nama_npwp = $request->nama_npwp;
        $data->nama_npwp = "";
        $data->kswp_npwp = $request->kswp_npwp;
        $data->kswp_nama = $request->kswp_nama;
        $data->penawaran = 0;
        $data->harga_koreksi = 0;
        $data->user_id = $user->id;
        $data->save();
        //upload file setelah falidasi
        foreach ($file->tender_file as $key => $ts) {
            # code...
            $x = $ts->id;
            $tmp_file = $request->file($x);
            $file = time().".".$tmp_file->getClientOriginalExtension();

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
                // $tfs->status_id = 0;
                $tfs->save();
            }
        }
        // return redirect()->route('tender_home.index');
        return redirect()->route('pengalaman.show',$data->id);


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
            $file = tender_file::where('tender_id',$id)->get();
            // $now = Carbon::now();
            return view('tender_user.peserta.create',['data'=>$data, 'file'=>$file]);
        }
        return redirect()->route('peserta.file',['id'=>$id,'pid'=>$peserta->id]);

    }
    public function show_peserta($id)
    {

        $data = tender::findorfail($id);
        $peserta = daftar_peserta::
        join('pesertas','pesertas.id','daftar_pesertas.peserta_id')
        ->join('tenders','tenders.id','pesertas.tender_id')
        // ->join('tender_files','tender_files.tender_id','tenders.id')
        // ->join('tender_file_details','tender_file_details.tender_file_id','tender_files.id')
        // ->where('tenders.id',$id)
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
        ->findorfail($pid);

        $penawaran_peserta=penawaran_peserta::where('peserta_id',$pid)->where('tender_id',$id)->first();
        // $penawaran_file = $penawaran_peserta->penawaran_peserta_file;
         $file = tender_file_detail::join('pesertas','pesertas.id','tender_file_details.peserta_id')
        ->join('tender_files','tender_files.id','tender_file_details.tender_file_id')
        ->join('tenders','tenders.id','tender_files.tender_id')
        ->where('pesertas.id',$pid)
        ->where('tenders.id',$id)
        ->select('tender_file_details.id as id','tender_files.nama as nama_file'
        ,'tender_file_details.files as file')
        ->get();

        $komen = tender_komen::where('peserta_id',$pid)

        ->join('pesertas','pesertas.id','tender_komens.peserta_id')
        ->join('users','users.id','tender_komens.user_id')
        ->select('tender_komens.*','pesertas.nama_pt as pt','users.name as user','users.hak_akses as hak_akses')
        ->get();


        $berkas = tender_file_detail::where('tender_id',$data->tender_id)
        ->where('peserta_id',$data->id)
        ->get();

        // foreach ($berkas as $key => $value) {
        //     # code...
        //     echo $value->tender_file->nama."<br>";
        // }
        $pemeriksanaan = $data->pemeriksaan;

        $nilai = pemeriksaan::where('tender_id',$data->tender_id)
        ->orderBy('nilai','desc')
        ->get();

        $hak_akses = Auth::user();

        $p_admin = penilaian_administrasi::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->first();
        $p_kualifikasi = penilaian_kualifikasi::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->first();
        $p_teknis = penilaian_teknis::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->first();
        $p_peserta = penilaian_penawaran_peserta::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->first();
        $point = $this->point_tender($p_admin,$p_kualifikasi,$p_teknis,$p_peserta);;
        $admin = administrasi_detail::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->get();
        $file_rkk = file_teknis::where('peserta_id',$pid)->where('tender_id',$data->tender_id)->get();
        return view('tender_user.peserta.files.show',
        ['data'=>$data,'file'=>$file,
        'komen'=>$komen,'berkas'=>$berkas,'hak_akses'=>$hak_akses,
        'pemeriksaan' => $pemeriksanaan, 'nilai'=>$nilai,'pp'=>$penawaran_peserta,
        'admin' =>$admin,'pa'=>$p_admin,'pk'=>$p_kualifikasi,'pt'=>$p_teknis,'p_peserta'=>$p_peserta,
        'point' => $point,'file_rkk'=>$file_rkk
        ]);


    }
    public function send_hasil(Request $request)
    {
        $pid = $request->peserta_id;
        $tender_id = $request->tender_id;
        $point = $request->point;
        $p_admin = penilaian_administrasi::where('peserta_id',$pid)->where('tender_id',$tender_id)->first();
        $p_kualifikasi = penilaian_kualifikasi::where('peserta_id',$pid)->where('tender_id',$tender_id)->first();
        $p_teknis = penilaian_teknis::where('peserta_id',$pid)->where('tender_id',$tender_id)->first();
        $p_peserta = penilaian_penawaran_peserta::where('peserta_id',$pid)->where('tender_id',$tender_id)->first();
        $email = $request->email;
        $pa = $p_admin;
        $pk = $p_kualifikasi;
        $pt = $p_teknis;
        $p_peserta = $p_peserta;
        if ($point>=4) {
            # code...
            $point_k = "Selamat Anda Lulus dan akan masuk ke tahap selanjutnya";
        } else {
            # code...
            $point_k = "Kami dari panitia tender menyampaikan bahwa saudara belum dapat dinyatakan lulus dalam seleksi administrasi";
        }

        $data = [
            'pa_s' => $pa['status'],
            'pa_k' => $pa['keterangan'],
            'pk_s' => $pk['status'],
            'pk_k' => $pk['keterangan'],
            'pt_s' => $pt['status'],
            'pt_k' => $pt['keterangan'],
            'pp_s' => $p_peserta['status'],
            'pp_k' => $p_peserta['keterangan'],
            'poin' => $point_k
        ];
        # code...
        Mail::to($email)->send(new hasil_penilaian($data));
        return back()->with('status','Mail sent successfully');;
    }

    public function point_tender($p_admin,$p_kualifikasi,$p_teknis,$p_peserta)
    {
        # code...
        $point = 0;
        if ($p_admin) {
            # code...
            if ($p_admin->status == "Lulus") {
                # code...
                $point += 1;
            }
        }
        if ($p_kualifikasi) {
            # code...
            if ($p_kualifikasi->status == "Lulus") {
                # code...
                $point += 1;
            }
        }
        if ($p_teknis) {
            # code...
            if ($p_teknis->status == "Lulus") {
                # code...
                $point += 1;
            }
        }
        if ($p_peserta) {
            # code...
            if ($p_peserta->status == "Lulus") {
                # code...
                $point += 1;
            }
        }
        return $point;
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
        $data = peserta::join('tenders','tenders.id','pesertas.tender_id')
        ->select('pesertas.*','tenders.nama as nama_tender')
        ->findorfail($id);

         $file = tender_file_detail::join('pesertas','pesertas.id','tender_file_details.peserta_id')
        ->join('tender_files','tender_files.id','tender_file_details.tender_file_id')
        ->join('tenders','tenders.id','tender_files.tender_id')
        ->where('pesertas.id',$id)
        ->where('tenders.id',$data->tender_id)
        ->select('tender_file_details.id as id','tender_files.nama as nama_file'
        ,'tender_file_details.files as file')
        ->get();

        return view('tender_user.peserta.edit',['data'=>$data,'file'=>$file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(pesertaRequest $request, $id)
    {
        // return $request;
        $data =  peserta::findorfail($id);

        // return  $file = tender_file_detail::join('tender_files','tender_files.id','tender_file_details.tender_file_id')
        // ->where('tender_file_details.tender_id',$data->tender_id)
        // ->where('tender_file_details.peserta_id',$data->id)
        // ->select('tender_file_details.*','tender_files.nama as nama')
        // ->get();

        $file = tender_file_detail::join('pesertas','pesertas.id','tender_file_details.peserta_id')
        ->join('tender_files','tender_files.id','tender_file_details.tender_file_id')
        ->join('tenders','tenders.id','tender_files.tender_id')
        ->where('pesertas.id',$data->id)
        ->where('tenders.id',$data->tender_id)
        ->select('tender_file_details.id as id','tender_files.nama as nama_file'
        ,'tender_file_details.files as file')
        ->get();
        //validasi file yang di upload
        // foreach ($file as $key => $tc) {
        //     # code...
        //     $x = $tc->tender_file_id;
        //     if (!$request->$x) {
        //         # code...
        //         return Redirect::back()->withErrors(['msg' => 'File '.$tc->nama.' Tidak Boleh Kosong']);
        //     }
        // }

        // $data->tender_id = $request->id;
        $data->nama_pt = $request->nama_pt;
        // $data->NPWP = $request->NPWP;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->izin = $request->izin;
        $data->nomor_izin = $request->nomor_izin;
        $data->izin_berlaku = $request->izin_berlaku;
        $data->instansi_pemberi = $request->instansi_pemberi;
        $data->kualifikasi = $request->kualifikasi;
        $data->klasifikasi = $request->klasifikasi;
        $data->no_akta = $request->no_akta;
        $data->tgl_akta = $request->tgl_akta;
        $data->notaris = $request->notaris;
        $data->no_aktab = $request->no_aktab;
        $data->tgl_aktab = $request->tgl_aktab;
        $data->notaris_b = $request->notaris_b;
        // $data->nama_npwp = $request->nama_npwp;
        $data->kswp_npwp = $request->kswp_npwp;
        $data->kswp_nama = $request->kswp_nama;;
        // $data->penawaran = $request->penawaran;
        $data->harga_koreksi = 0;
        $data->save();
        //upload file setelah falidasi
        foreach ($file as $key => $ts) {
            # code...
            // return $ts;
            $x = $ts->id;
            // echo $ts->id.". ".$ts."<br>";
            // echo $x.'<br>';
            if ($request->$x) {

            $tmp_file = $request->file($x);
            $file = time().".".$tmp_file->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id.'/'.$ts->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat link
            $nama_file=$tujuan_upload.'/'.$file;

                # code...
                //id 	tender_file_id 	user_id 	files 	keterangan 	created_at 	updated_at 	deleted_at
                $tfs = tender_file_detail::findorfail($x);
                echo $tfs;
                $tfs->files = $nama_file;
                $tfs->save();
                // return $tfs;
            }
        }
        // return 0;
        // return redirect()->route('tender_home.show',$data->tender_id);
        return redirect()->back();



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
