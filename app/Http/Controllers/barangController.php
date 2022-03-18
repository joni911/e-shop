<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\barang_photo;
use App\Models\inventory_barang;
use App\Models\katagori_barang;
use App\Models\komentar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->validate($request, [
			'nama' => 'required',
            'keterangan' => 'required',
            'katagori' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
		]);

        $store = new barang;
        $store->nama = $request->nama;
        $store->keterangan = $request->keterangan;
        $store->katagori_barang_id = $request->katagori;
        $store->deskripsi = $request->deskripsi;
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

        // return $barang->barang_photo;

        return view('Barang.photo',['barang'=>$barang]);
    }
    public function edit_photo($id)
    {
        $barang = barang::findorfail($id);

        // return $barang->barang_photo;

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
        $user = Auth::user();
        $mytime = Carbon::now();
        $tahun =  $mytime->isoFormat('YYYY');
        $bulan =  $mytime->isoFormat('MM');

        $foto = $request->file('file');

        $nama_foto = $user->id.'-'.$mytime->isoFormat('YYYYMMDDHHmmss').'.'.$foto->getClientOriginalExtension();

        $tujuan_upload =$user->id.'/images'.'/'.$tahun.'/'.$bulan.'/'.$user->id;
        $foto->move(public_path($tujuan_upload),$nama_foto);
        $nama_file = $tujuan_upload.'/'.$nama_foto;

        $ps = new barang_photo();
        $ps->barang_id = $request->id;
        $ps->foto = $nama_file;
        $ps->save();


        return redirect()->route('photo.buat',['id' => $request->id]);
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

        $komentar = komentar::join('barangs','barangs.id','komentars.barang_id')
        ->join('Users','Users.id','komentars.user_id')
        ->where('barangs.id',$id)
        ->select('komentars.*','Users.name as nama_user','barangs.nama as nama_barang')
        ->get();

        // return $komentar;
        return view('Barang.show',['barang'=>$barang,'komentar'=>$komentar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $katagori = katagori_barang::get();

        $barang = barang::findorfail($id);

        // return $barang;
        return view('Barang.edit',['katagori'=>$katagori,'barang'=>$barang]);

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
        // return 'update';
        $this->validate($request, [
			'nama' => 'required',
            'keterangan' => 'required',
            'katagori' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
		]);

        $store = barang::findorfail($id);
        $store->nama = $request->nama;
        $store->keterangan = $request->keterangan;
        $store->katagori_barang_id = $request->katagori;
        $store->deskripsi = $request->deskripsi;
        $store->harga = $request->harga;
        $store->save();

        $inv = $store->inventory_barang;
        $inv->jumlah = $request->jumlah;
        $inv->save();


        return redirect()->route('photo.edit',['id' => $id]);

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
