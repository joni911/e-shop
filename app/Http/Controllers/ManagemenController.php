<?php

namespace App\Http\Controllers;

use App\Models\managemen;
use App\Http\Requests\StoremanagemenRequest;
use App\Http\Requests\UpdatemanagemenRequest;

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
    public function store(StoremanagemenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function show(managemen $managemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function edit(managemen $managemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemanagemenRequest  $request
     * @param  \App\Models\managemen  $managemen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemanagemenRequest $request, managemen $managemen)
    {
        //
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
