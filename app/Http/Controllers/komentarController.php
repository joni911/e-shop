<?php

namespace App\Http\Controllers;

use App\Models\komentar;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class komentarController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request, [
			'komentar' => 'required',
		]);
        $user = Auth::user();

        $komen = new komentar();
        $komen->komentar = $request->komentar;
        $komen->barang_id = $request->id;
        $komen->user_id = $user->id;
        $komen->save();

        return redirect()->back();


    }

    public function send($user)
    {
        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Terimakasih Telah Mendaftar Di Layanan Pengadaan Barang jasa PT.co BANK Daerah bangli Perseroda.',
            'thanks' => 'Terima Kasih dari bankdaerahbangli.com',
            'actionText' => 'Kunjungi Situs Pengadaan',
            'actionURL' => url('/'),
            'id' => 57
        ];

        Notification::send($user, new EmailNotification($project));

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
