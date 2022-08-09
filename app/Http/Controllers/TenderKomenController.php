<?php

namespace App\Http\Controllers;

use App\Models\tender_komen;
use App\Http\Requests\Storetender_komenRequest;
use App\Http\Requests\Updatetender_komenRequest;
use App\Models\peserta;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TenderKomenController extends Controller
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
     * @param  \App\Http\Requests\Storetender_komenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetender_komenRequest $request)
    {
        $user = Auth::user();

        $data = new tender_komen();
        $data->user_id = $user->id;
        $data->peserta_id = $request->id;
        $data->komentar = $request->komentar;
        $data->save();

        $sendto = '';
        if ($user->hak_akses == 'admin') {
            # code...admin mengirim ke user
            $peserta = peserta::where('id',$request->id)->first();
            $sendto = $peserta->user;
            $this->send_user($sendto,$data);
        } else {
            # code...user mengirim ke admin
            $peserta = peserta::where('id',$request->id)->first();
            $sendto = $peserta->tender->user;

            $this->send_admin($sendto,$data);
        }


        return redirect()->back()->with(['success'=>'Data Berhasil Disimpan']);
    }

    public function send_user($user,$data)
    {
        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Admin tender '.$user->name.' Telah Mengirim Komentar '.$data->komentar,
            'thanks' => 'Terima Kasih dari bankdaerahbangli.com',
            'actionText' => 'Kunjungi Situs Pengadaan',
            'actionURL' => url('/'),
            'id' => 57
        ];

        Notification::send($user, new EmailNotification($project));

    }
    public function send_admin($user,$data)
    {
        $project = [
            'greeting' => 'Hi Admin '.$user->name.',',
            'body' => 'Peserta tender '.$data->peserta->user->name.' Telah Mengirim Komentar '.$data->komentar,
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
     * @param  \App\Models\tender_komen  $tender_komen
     * @return \Illuminate\Http\Response
     */
    public function show(tender_komen $tender_komen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tender_komen  $tender_komen
     * @return \Illuminate\Http\Response
     */
    public function edit(tender_komen $tender_komen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetender_komenRequest  $request
     * @param  \App\Models\tender_komen  $tender_komen
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetender_komenRequest $request, tender_komen $tender_komen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tender_komen  $tender_komen
     * @return \Illuminate\Http\Response
     */
    public function destroy(tender_komen $tender_komen)
    {
        //
    }
}
