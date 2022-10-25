<?php

namespace App\Http\Controllers;

use App\Models\penilaian_tender;
use App\Http\Requests\Storepenilaian_tenderRequest;
use App\Http\Requests\Updatepenilaian_tenderRequest;
use App\Models\peserta;

class PenilaianTenderController extends Controller
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
     * @param  \App\Http\Requests\Storepenilaian_tenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenilaian_tenderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penilaian_tender  $penilaian_tender
     * @return \Illuminate\Http\Response
     */
    public function show($id,$pid)
    {
        //
        return $data = peserta::findorfail($id);
        foreach ($data->tender_file_detail as $key => $value) {
            # code...
            echo $value->tender_file;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penilaian_tender  $penilaian_tender
     * @return \Illuminate\Http\Response
     */
    public function edit(penilaian_tender $penilaian_tender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenilaian_tenderRequest  $request
     * @param  \App\Models\penilaian_tender  $penilaian_tender
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenilaian_tenderRequest $request, penilaian_tender $penilaian_tender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penilaian_tender  $penilaian_tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(penilaian_tender $penilaian_tender)
    {
        //
    }
}
