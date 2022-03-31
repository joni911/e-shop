<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender extends Model
{
    use HasFactory,SoftDeletes;

    public function status()
    {
        # code...
        return $this->hasOne('App\Models\status_tender');
    }
    public function metode()
    {
        # code...
         return $this->hasOne('App\Models\metode_pengadaan');
    }

    public function jenis_kontrak()
    {
        # code...
         return $this->hasOne('App\Models\jenis_kontrak');
    }
    public function jenis_pengadaan()
    {
        # code...
         return $this->hasOne('App\Models\jenis_pengadaan');
    }
    public function tahapan()
    {
        # code...
        return $this->hasMany('App\Models\tahapan');
    }
    public function syarat()
    {
        # code...
        return $this->hasMany('App\Models\syarat');
    }
    public function tender_file()
    {
        # code...
        return $this->hasMany('App\Models\tender_file');
    }
}
