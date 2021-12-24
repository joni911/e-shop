<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class alamat_user extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = [
            'nama',
            'alamat',
            'kota',
            'kecamatan',
            'provinsi',
            'wa'
    ];
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
