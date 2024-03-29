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
        return $this->hasMany(syarat::class);
    }
    public function tender_file()
    {
        # code...
        return $this->hasMany(tender_file::class);
    }
    public function peserta()
    {
        # code...
        return $this->hasMany(peserta::class);
    }
    public function pengalaman()
    {
        # code...
        return $this->hasMany(pengalaman_tender::class);
    }
    public function peralatan()
    {
        # code...
        return $this->hasMany(peralatan::class);
    }
    public function managemen()
    {
        # code...
        return $this->hasMany(managemen::class);
    }
    public function tenaga_ahli()
    {
        # code...
        return $this->hasMany(tenaga_ahli::class);
    }
    public function pekerjaan()
    {
        # code...
        return $this->hasMany(pekerjaan_berjalan::class);
    }
    public function pemeriksaan()
    {
        # code...
        return $this->hasMany(pemeriksaan::class);

    }
    public function user()
    {
        # code...
        return $this->belongsTo(user::class);

    }
    public function daftar_peserta()
    {
        # code...
        return $this->hasMany(daftar_peserta::class);

    }

    public function tender_persyaratan()
    {
        # code...
        return $this->hasOne(tender_persyaratan::class);
    }

    public function penawaran()
    {
        # code...
        return $this->hasOne(penawaran::class);
    }
}
