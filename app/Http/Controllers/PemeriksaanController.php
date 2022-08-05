<?php

namespace App\Http\Controllers;

use App\Models\pemeriksaan;
use App\Http\Requests\StorepemeriksaanRequest;
use App\Http\Requests\UpdatepemeriksaanRequest;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
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
     * @param  \App\Http\Requests\StorepemeriksaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepemeriksaanRequest $request)
    {
        $user = Auth::user();
        $data = new pemeriksaan();
        $data->user_id = $user->id;
        $data->tender_id = $request->tender_id;
        $data->peserta_id = $request->peserta_id;
        $data->pengalaman = $request->pengalaman;
        $data->kpengalaman = $request->kpengalaman;
        $data->tenaga_ahli = $request->tenaga_ahli;
        $data->ktenaga_ahli = $request->ktenaga_ahli;
        $data->peralatan = $request->peralatan;
        $data->kperalatan = $request->kperalatan;
        $data->pekerjaan_berjalan = $request->pekerjaan_berjalan;
        $data->kpekerjaan_berjalan = $request->kpekerjaan_berjalan;
        $data->managemen = $request->managemen;
        $data->kmanagemen = $request->kmanagemen;
        $data->file = $request->file;
        $data->kfile = $request->kfile;
        $data->save();


        return redirect()->back()->with('success','Data telah disimpan');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function show(pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function edit(pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepemeriksaanRequest  $request
     * @param  \App\Models\pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function penilaian($request)
    {
        $nilai = 0;
        if ($request->pengalaman == 'Lulus') {
            $nilai +=1;
        }if ($request->tenaga_ahli == 'Lulus') {
            $nilai +=1;
        }if ($request->peralatan == 'Lulus') {
            $nilai +=1;
        }if ($request->pekerjaan_berjalan == 'Lulus') {
            $nilai +=1;
        }if ($request->managemen == 'Lulus') {
            $nilai +=1;
        }if ($request->file == 'Lulus') {
            $nilai +=1;
        }
       return $total = $nilai/6*100;
    }
    public function update(UpdatepemeriksaanRequest $request, pemeriksaan $pemeriksaan)
    {

        $total = $this->penilaian($request);
        $kesimpulan = "Tidak Lulus";
        if ($total >= 100) {
            $kesimpulan = 'Lulus';
        }

        $data = $pemeriksaan;
        $data->pengalaman = $request->pengalaman;
        $data->kpengalaman = $request->kpengalaman;
        $data->tenaga_ahli = $request->tenaga_ahli;
        $data->ktenaga_ahli = $request->ktenaga_ahli;
        $data->peralatan = $request->peralatan;
        $data->kperalatan = $request->kperalatan;
        $data->pekerjaan_berjalan = $request->pekerjaan_berjalan;
        $data->kpekerjaan_berjalan = $request->kpekerjaan_berjalan;
        $data->managemen = $request->managemen;
        $data->kmanagemen = $request->kmanagemen;
        $data->file = $request->file;
        $data->kfile = $request->kfile;
        $data->nilai = $total;
        $data->kesimpulan = $kesimpulan;
        $data->save();


        return redirect()->back()->with('success','Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemeriksaan $pemeriksaan)
    {
        //
    }
}
