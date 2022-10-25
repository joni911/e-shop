<?php

namespace App\Http\Controllers;

use App\Models\proses_tender;
use App\Http\Requests\Storeproses_tenderRequest;
use App\Http\Requests\Updateproses_tenderRequest;

class ProsesTenderController extends Controller
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
     * @param  \App\Http\Requests\Storeproses_tenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproses_tenderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\proses_tender  $proses_tender
     * @return \Illuminate\Http\Response
     */
    public function show(proses_tender $proses_tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\proses_tender  $proses_tender
     * @return \Illuminate\Http\Response
     */
    public function edit(proses_tender $proses_tender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproses_tenderRequest  $request
     * @param  \App\Models\proses_tender  $proses_tender
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproses_tenderRequest $request, proses_tender $proses_tender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\proses_tender  $proses_tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(proses_tender $proses_tender)
    {
        //
    }
}
