<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penawaran_peserta extends Model
{
    use HasFactory, SoftDeletes;

    public function penawaran()
    {
        # code...
        return $this->belongsTo(penawaran::class);
    }
}
