<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'hak_akses'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasMany('App\Models\order');
    }
    public function sesi_belanja()
    {
        return $this->hasMany('App\Models\sesi_belanja');
    }

    public function alamat_user()
    {
        return $this->hasMany('App\Models\alamat_user');
    }
    public function komentar()
    {
        # code...
        return $this->hasMany('App\Models\komentar');

    }
    public function peserta()
    {
        return $this->hasOne(peserta::class);
    }
    public function peralatan()
    {
        # code...
        return $this->hasMany(peralatan::class);
    }
    public function pemeriksaan()
    {
        # code...
        return $this->hasMany(pemeriksaan::class);

    }

    public function tender()
    {
        # code...
        return $this->hasMany(tender::class);

    }

    public function daftar_peserta()
    {
        # code...
        return $this->belongsTo(daftar_peserta::class);

    }
    public function tender_persyaratan()
    {
        # code...
        return $this->belongsTo(tender_persyaratan::class);

    }
    public function tender_persyaratan_file()
    {
        # code...
        return $this->belongsTo(tender_persyaratan_file::class);

    }
}
