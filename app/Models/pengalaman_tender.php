<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengalaman_tender extends Model
{
    use HasFactory;

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
