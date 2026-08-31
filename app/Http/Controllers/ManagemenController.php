<?php

namespace App\Http\Controllers;

use App\Models\managemen;
use App\Http\Requests\StoremanagemenRequest;
use App\Http\Requests\UpdatemanagemenRequest;
use App\Models\peserta;
use Illuminate\Support\Facades\Auth;

class ManagemenController extends Controller
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
     * @param  \App\Http\Requests\StoremanagemenRequest  $request
     * @return \Illuminate\Http\Response
     */

     public function file1($request)
     {
        # code...
        $nama_file = "";
        if ($request->file1) {
            # code...
            $tmp_file = $request->file('file1');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }
     public function file2($request)
     {
        # code...
        $nama_file ="";
        if ($request->file2) {
            # code...
            $tmp_file = $request->file('file2');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }

     public function file3($request)
     {
        # code...
        $nama_file ="";
        if ($request->file3) {
            # code...
            $tmp_file = $request->file('file3');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }
     public function file4($request)
     {
        # code...
        $nama_file ="";
        if ($request->file4) {
            # code...
            $tmp_file = $request->file('file4');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }

     public function file5($request)
     {
        # code...
        $nama_file ="";
        if ($request->file5) {
            # code...
            $tmp_file = $request->file('file5');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$request->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }
    public function store(StoremanagemenRequest $request)
    {
        // file upload
        // note ambil id peserta buat folder peserta go!
        $nf1 = $this->file1($request);
        $nf2 = $this->file2($request);
        $nf3 = $this->file3($request);
        $nf4 = $this->file4($request);
        $nf5 = $this->file5($request);

        $user = Auth::user();
        $data = new managemen();
        $data->user_id = $user->id;
        $data->peserta_id = $request->id;
        $data->tender_id = $request->tender_id;
        $data->nama = $request->nama;
        $data->tgl_menjabat = $request->tgl_menjabat;
        $data->tgl_berakhir = $request->tgl_berakhir;
        $data->ktp = $request->ktp;
        $data->alamat = $request->alamat;
        $data->npwp = $request->npwp;
        $data->status = $request->status;
        $data->file1 = $nf1;
        $data->ket1 = $request->ket1;
        $data->file2 = $nf2;
        $data->ket2 = $request->ket2;
        $data->file3 = $nf3;
        $data->ket3 = $request->ket3;
        $data->file4 = $nf4;
        $data->ket4 = $request->ket4;
        $data->file5 = $nf5;
        $data->ket5 = $request->ket5;
        $data->save();
        return redirect()->back()->with('success','Data '.$data->nama.' telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 'show';
        $data = '';
        $p = peserta::findorfail($id);
        $list = managemen::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.managemen.create',['managemen'=>$p,'list'=>$list,'status'=>$status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = 'edit';
        $data = managemen::findorfail($id);
        $p = peserta::findorfail($data->peserta_id);
        $list = managemen::where('peserta_id',$p->id)->where('tender_id',$p->tender_id)->paginate(10);
        return view('tender_user.peserta.managemen.create',['managemen'=>$p,'list'=>$list,'status'=>$status,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemanagemenRequest  $request
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemanagemenRequest $request, $id)
    {
        $user = Auth::user();
        $data = managemen::findorfail($id);

        $nf1 = $this->ufile1($request,$data);
        $nf2 = $this->ufile2($request,$data);
        $nf3 = $this->ufile3($request,$data);
        $nf4 = $this->ufile4($request,$data);
        $nf5 = $this->ufile5($request,$data);


        $data->nama = $request->nama;
        $data->tgl_menjabat = $request->tgl_menjabat;
        $data->tgl_berakhir = $request->tgl_berakhir;
        $data->ktp = $request->ktp;
        $data->alamat = $request->alamat;
        $data->npwp = $request->npwp;
        $data->status = $request->status;
        if ($nf1) {
            $data->file1 = $nf1;
        }if ($nf2) {
            $data->file2 = $nf2;
        }if ($nf3) {
            $data->file3 = $nf3;
        }if ($nf4) {
            $data->file4 = $nf4;
        }if ($nf5) {
            $data->file5 = $nf5;
        }

        if ($request->ket1) {
            $data->ket1 = $request->ket1;
        }if ($request->ket2) {
            $data->ket2 = $request->ket2;
        }if ($request->ket3) {
            $data->ket3 = $request->ket3;
        }if ($request->ket4) {
            $data->ket4 = $request->ket4;
        }if ($request->ket5) {
            $data->ket5 = $request->ket5;
        }


        $data->save();
        return redirect()->route("managemen.show",$data->peserta_id)->with('success','Data '.$data->nama.' telah diupdate');
    }

    public function ufile1($request,$data)
     {
        # code...
        $nama_file = "";
        if ($request->file1) {
            # code...
            $tmp_file = $request->file('file1');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }
     public function ufile2($request,$data)
     {
        # code...
        $nama_file ="";
        if ($request->file2) {
            # code...
            $tmp_file = $request->file('file2');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }

     public function ufile3($request,$data)
     {
        # code...
        $nama_file ="";
        if ($request->file3) {
            # code...
            $tmp_file = $request->file('file3');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }
     public function ufile4($request,$data)
     {
        # code...
        $nama_file ="";
        if ($request->file4) {
            # code...
            $tmp_file = $request->file('file4');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }

     public function ufile5($request,$data)
     {
        # code...
        $nama_file ="";
        if ($request->file5) {
            # code...
            $tmp_file = $request->file('file5');
            $file = time().".".$tmp_file->getClientOriginalExtension();

      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'Tender/FILE/'.$data->id;
            $tmp_file->move($tujuan_upload,$file);
            //nama file dan tujuan di jadikan satu agar mudah di buat linkgit
            $nama_file=$tujuan_upload.'/'.$file;
        }

        return $nama_file;

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function destroy(managemen $managemen)
    {
        //
    }
}
