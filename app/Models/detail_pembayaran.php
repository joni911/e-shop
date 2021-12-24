<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail_pembayaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'pembayaran',
        'provider',
        'status'
    ];
    protected $dates = ['deleted_at'];


    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
}
