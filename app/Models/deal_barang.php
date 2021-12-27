<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class deal_barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'harga',
        'keterangan'
    ];
    protected $dates = ['deleted_at'];

    public function barang()
    {
        return $this->belongsTo('App\Models\barang');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\order');
    }
}
