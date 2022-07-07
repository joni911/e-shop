<?php

namespace App\Http\Controllers;

use App\Models\status_tender;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class StatusTenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
    	$user = User::first();

        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Terimakasih Telah Mendaftar Di Layanan Pengadaan Barang jasa PT. BANK Daerah bangli Perseroda.',
            'thanks' => 'Terima Kasih dari bankdaerahbangli.com',
            'actionText' => 'Kunjungi Situs Pengadaan',
            'actionURL' => url('/'),
            'id' => 57
        ];

        Notification::send($user, new EmailNotification($project));

        dd('Notification sent!');
    }

     public function index()
    {
        //
         $data = status_tender::paginate(10);

        return view('status_tender.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('status_tender.create');

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

        $data = new status_tender();
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('status_tender.index');
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
        //
        $data = status_tender::findorfail($id);

        return view('status_tender.edit',['data'=>$data]);
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

        $data = status_tender::findorfail($id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('status_tender.index');
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
        $data = status_tender::findorfail($id);
        $data->delete();

        return redirect()->back();
    }
}
