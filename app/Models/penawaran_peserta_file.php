<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penawaran_peserta_file extends Model
{
    use HasFactory,SoftDeletes;

    public function peserta_file()
    {
        # code...
        return $this->belongsTo(peserta_file::class);
    }
}
