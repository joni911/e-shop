<?php

namespace App\Http\Controllers;

use App\Models\metode_pengadaan;
use Illuminate\Http\Request;

class MetodePengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = metode_pengadaan::paginate(10);

        return view('metode_pengadaan.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('metode_pengadaan.create');

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

        $data = new metode_pengadaan();
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('metode_pengadaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\metode_pengadaan  $metode_pengadaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\metode_pengadaan  $metode_pengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
          $data = metode_pengadaan::findorfail($id);

        return view('metode_pengadaan.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\metode_pengadaan  $metode_pengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request, [
			'nama' => 'required'
		]);

        $data = metode_pengadaan::findorfail($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('metode_pengadaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\metode_pengadaan  $metode_pengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = metode_pengadaan::findorfail($id);
        $data->delete();

        return redirect()->back();
    }
}
