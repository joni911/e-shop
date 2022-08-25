<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penawaran_peserta_file extends Model
{
    use HasFactory,SoftDeletes;

    public function penawaran_peserta()
    {
        # code...
        return $this->belongsTo(penawaran_peserta::class);
    }

}
