<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class barang_photo extends Model
{
    use HasFactory,SoftDeletes;

    public function barang()
    {
        return $this->belongsTo('App\Models\barang');
    }
}
