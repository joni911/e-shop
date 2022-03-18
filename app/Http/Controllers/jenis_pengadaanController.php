<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengadaan;
use Illuminate\Http\Request;

class jenis_pengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = jenis_pengadaan::paginate(10);

        return view('jenis_pengadaan.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jenis_pengadaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
			'nama' => 'required'

		]);

        $data = new jenis_pengadaan();
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('jenis_pengadaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = jenis_pengadaan::findorfail($id);

        return view('jenis_pengadaan.edit',['data'=>$data]);
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
        //
        $this->validate($request, [
			'nama' => 'required'
		]);

        $data = jenis_pengadaan::findorfail($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('jenis_pengadaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = jenis_pengadaan::findorfail($id);
        $data->delete();

        return redirect()->back();
    }
}
