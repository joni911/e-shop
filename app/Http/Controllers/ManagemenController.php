<?php

namespace App\Http\Controllers;

use App\Models\managemen;
use App\Http\Requests\StoremanagemenRequest;
use App\Http\Requests\UpdatemanagemenRequest;
use App\Models\peserta;
use App\Models\tender;
use App\Services\FileUploadService;
use App\Services\PesertaWizardService;
use App\Services\TenderContext;
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
        return $this->uploadFileField($request, 'file1', 'Tender/FILE/'.$request->id);
     }
     public function file2($request)
     {
        return $this->uploadFileField($request, 'file2', 'Tender/FILE/'.$request->id);
     }

     public function file3($request)
     {
        return $this->uploadFileField($request, 'file3', 'Tender/FILE/'.$request->id);
     }
     public function file4($request)
     {
        return $this->uploadFileField($request, 'file4', 'Tender/FILE/'.$request->id);
     }

     public function file5($request)
     {
        return $this->uploadFileField($request, 'file5', 'Tender/FILE/'.$request->id);
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
        $profil = $user->peserta;
        if ($profil && !$request->filled('id')) {
            $request->id = $profil->id;
        }
        if ($profil && !$request->filled('tender_id')) {
            $request->tender_id = TenderContext::tenderId($profil->tender_id ?? null) ?? $profil->tender_id;
        }
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
        $tenderId = TenderContext::tenderId($p->tender_id);
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = managemen::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.managemen.create', [
            'managemen' => $p, 'peserta' => $p,
            'steps' => PesertaWizardService::steps($p, 'managemen'),
            'list' => $list, 'status' => $status,
            'tenderId' => $tenderId, 'tender' => $tender,
        ]);
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
        $tenderId = empty($data->tender_id) ? TenderContext::tenderId($p->tender_id) : $data->tender_id;
        $tender = $tenderId ? tender::find($tenderId) : null;
        $list = managemen::where('peserta_id', $p->id)->where('tender_id', $tenderId)->paginate(10);
        return view('tender_user.peserta.managemen.create', [
            'managemen' => $p, 'peserta' => $p,
            'steps' => PesertaWizardService::steps($p, 'managemen'),
            'list' => $list, 'status' => $status, 'data' => $data,
            'tenderId' => $tenderId, 'tender' => $tender,
        ]);
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
        return $this->uploadFileField($request, 'file1', 'Tender/FILE/'.$data->id, $data->file1);
     }
     public function ufile2($request,$data)
     {
        return $this->uploadFileField($request, 'file2', 'Tender/FILE/'.$data->id, $data->file2);
     }

     public function ufile3($request,$data)
     {
        return $this->uploadFileField($request, 'file3', 'Tender/FILE/'.$data->id, $data->file3);
     }
     public function ufile4($request,$data)
     {
        return $this->uploadFileField($request, 'file4', 'Tender/FILE/'.$data->id, $data->file4);
     }

     public function ufile5($request,$data)
     {
        return $this->uploadFileField($request, 'file5', 'Tender/FILE/'.$data->id, $data->file5);
     }

     /**
      * Helper upload field file (create/update) dengan nama unik.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  string  $field  nama input file
      * @param  string  $dir    folder relatif public
      * @param  string|null  $old   file lama (untuk dihapus saat update)
      * @return string
      */
     private function uploadFileField($request, string $field, string $dir, ?string $old = null): string
     {
        if (!$request->hasFile($field)) {
            return '';
        }
        $uploader = app(FileUploadService::class);
        if ($old) {
            $uploader->delete($old);
        }
        return $uploader->store($request->file($field), $dir, $field) ?? '';
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
