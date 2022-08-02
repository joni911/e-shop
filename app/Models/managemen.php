<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class managemen extends Model
{
    use HasFactory, SoftDeletes;

    public function tender()
    {
        # code...
        return $this->belongsTo(tender::class);
    }
    public function peserta()
    {
        return $this->belongsTo(peserta::class);
    }
}
