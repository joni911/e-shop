<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class katagori_barang extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'nama',
        'keterangan'
    ];
    protected $dates = ['deleted_at'];

    public function barang()
    {
        return $this->belongsTo('App\Models\barang');
    }
}
