<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class peserta extends Model
{
    use HasFactory,SoftDeletes;

    public function tender()
    {
        # code...
        return $this->belongsTo('App\Models\tender');
    }
    public function tender_file_detail()
    {
        # code...
        return $this->hasMany(tender_file_detail::class);
    }

    public function User()
    {
        # code...
        return $this->belongsTo(User::class);
    }

    public function komentar()
    {
        # code...
        return $this->hasMany(tender_komen::class);
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
        return $this->hasOne(pemeriksaan::class);

    }
    public function daftar_peserta()
    {
        # code...
        return $this->hasMany(daftar_peserta::class);

    }
    public function penawaran_peserta()
    {
        # code...
        return $this->belongsTo(penawaran_peserta::class);
    }
}
