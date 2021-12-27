<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class keranjang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sesi_belanja_id',
        'barang_id',
        'jumlah'

    ];
    protected $dates = ['deleted_at'];

    public function sesi_belanja()
    {
        return $this->belongsTo('App\Model\sesi_belanja');
    }

}
