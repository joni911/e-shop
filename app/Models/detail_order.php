<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail_order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'barang_id',
        'jumlah'
    ];
    protected $dates = ['deleted_at'];


    public function order()
    {
        return $this->belongsTo('App\Model\order');
    }
}
