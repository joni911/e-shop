<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'detail_pembayaran_id',
        'total'
    ];

    protected $dates = ['deleted_at'];


    public function detail_pembayaran()
    {
        return $this->hasOne('App\Models\detail_pembayaran');
    }

    public function detail_order()
    {
        return $this->hasMany('App\Models\detail_order');
    }
    
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
