<?php

namespace App\Http\Controllers;

use App\Models\pemenang_tender;
use App\Http\Requests\Storepemenang_tenderRequest;
use App\Http\Requests\Updatepemenang_tenderRequest;

class PemenangTenderController extends Controller
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
     * @param  \App\Http\Requests\Storepemenang_tenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepemenang_tenderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemenang_tender  $pemenang_tender
     * @return \Illuminate\Http\Response
     */
    public function show(pemenang_tender $pemenang_tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemenang_tender  $pemenang_tender
     * @return \Illuminate\Http\Response
     */
    public function edit(pemenang_tender $pemenang_tender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepemenang_tenderRequest  $request
     * @param  \App\Models\pemenang_tender  $pemenang_tender
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepemenang_tenderRequest $request, pemenang_tender $pemenang_tender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemenang_tender  $pemenang_tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemenang_tender $pemenang_tender)
    {
        //
    }
}
