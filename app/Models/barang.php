<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class barang extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'katagori_barang_id',
        'nama',
        'keterangan',
        'deskripsi',
        'harga'
    ];
    protected $dates = ['deleted_at'];


    public function katagori_barang()
    {
        return $this->hasOne('App\Models\katagori_barang');
    }

    public function inventory_barang()
    {
        return $this->hasOne('App\Models\inventory_barang');
    }

    public function deal_barang()
    {
        return $this->hasOne('App\Models\deal_barang');
    }

    public function barang_photo()
    {
        return $this->hasMany('App\Models\barang_photo');
    }
    public function komentar()
    {
        # code...
        return $this->hasMany('App\Models\komentar');

    }
}
