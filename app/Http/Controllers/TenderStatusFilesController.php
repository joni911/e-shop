<?php

namespace App\Http\Controllers;

use App\Models\tender_status_files;
use App\Http\Requests\Storetender_status_filesRequest;
use App\Http\Requests\Updatetender_status_filesRequest;

class TenderStatusFilesController extends Controller
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
     * @param  \App\Http\Requests\Storetender_status_filesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetender_status_filesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tender_status_files  $tender_status_files
     * @return \Illuminate\Http\Response
     */
    public function show(tender_status_files $tender_status_files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tender_status_files  $tender_status_files
     * @return \Illuminate\Http\Response
     */
    public function edit(tender_status_files $tender_status_files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetender_status_filesRequest  $request
     * @param  \App\Models\tender_status_files  $tender_status_files
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetender_status_filesRequest $request, tender_status_files $tender_status_files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tender_status_files  $tender_status_files
     * @return \Illuminate\Http\Response
     */
    public function destroy(tender_status_files $tender_status_files)
    {
        //
    }
}
