<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\inventory_barang;
use App\Models\katagori_barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = barang::get();

        return view('Barang.index',['barang'=>$barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $katagori = katagori_barang::get();

        return view('Barang.create',['katagori'=>$katagori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new barang;
        $store->nama = $request->nama;
        $store->keterangan = $request->keterangan;
        $store->katagori_barang_id = $request->katagori;
        $store->harga = $request->harga;
        $store->save();

        $inv = inventory_barang::create([
            'barang_id'=>$store->id,
            'jumlah'=>$request->jumlah
        ]);


        return redirect()->route('photo.buat',['id' => $store->id]);
    }

    public function create_photo(Request $request)
    {
        $barang = barang::findorfail($request->id);

        // return $barang;

        return view('Barang.photo',['barang'=>$barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function photoStore(Request $request)
    {
        $store = new barang;
        $store->nama = $request->nama;
        $store->keterangan = $request->keterangan;
        $store->katagori_barang_id = $request->katagori;
        $store->harga = $request->harga;
        $store->save();

        $inv = inventory_barang::create([
            'barang_id'=>$store->id,
            'jumlah'=>$request->jumlah
        ]);


        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = barang::findorfail($id);
        return view('Barang.show',['barang'=>$barang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
