<?php

namespace App\Http\Controllers;

use App\Models\tender;
use App\Models\tender_file;
use Illuminate\Http\Request;

class TenderFileController extends Controller
{
    //
    public function index()
    {
        //
        return view('tender_admin.files.create');
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
    public function store(Request $request)
    {
        $data = new tender_file();
        $data->tender_id = $request->id;
        $data->nama = $request->nama;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $page = 'lihat';
        $data = tender::findorfail($id);
        $table = tender_file::where('tender_id','=',$id)->paginate(20);
        return view('tender_admin.files.create',
        ['data'=>$data,'table'=>$table,'page'=>$page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'edit';
        $file = tender_file::findorfail($id);
        $data = tender::findorfail($file->tender_id);
        $table = tender_file::where('tender_id','=',$data->id)->paginate(10);
        return view('tender_admin.files.create',
        ['data'=>$data,'table'=>$table,
        'page'=>$page,'file'=>$file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = tender_file::findorfail($id);
        $data->tender_id = $request->id;
        $data->nama = $request->nama;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->route('tender_file.show',[$data->tender->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
