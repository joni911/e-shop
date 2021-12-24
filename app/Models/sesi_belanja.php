<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sesi_belanja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'total'
    ];

    protected $dates = ['deleted_at'];


    public function User()
    {
        return $this->hasMany('App\Models\User');
    }

    public function keranjang()
    {
        return $this->hasMany('App\Models\keranjang');
    }
}
