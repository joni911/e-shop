<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenis_kontrak extends Model
{
    use HasFactory,SoftDeletes;

    public function tender()
    {
        # code...
        return $this->belongsTo('App\Models\tender');
    }
}
