<?php

namespace App\Http\Controllers;

use App\Http\Requests\syaratRequest;
use App\Models\syarat;
use App\Models\tender;
use Illuminate\Http\Request;

class SyaratController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(syaratRequest $request)
    {
        //
        $data = new syarat();
        $data->tender_id = $request->id;
        $data->judul = $request->nama;
        $data->content = $request->content;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $syarat = syarat::findorfail($id);
        $data = syarat::join('tenders','tenders.id','syarats.tender_id')
        ->where('syarats.id',$id)
        ->select('syarats.*', 'tenders.nama as nama_tender')
        ->first();
        // return $data;
        $syarat = tender::findorfail($data->tender_id);

        return view('tender_admin.syarat.edit',
        [
            'data'=>$data,
            'syarat'=>$syarat
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = syarat::findorfail($id);
        $data->judul = $request->nama;
        $data->content = $request->content;
        $data->save();

        return redirect()->route('tender_admin.syarat',$data->tender_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
