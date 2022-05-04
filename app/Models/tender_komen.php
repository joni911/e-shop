<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender_komen extends Model
{
    use HasFactory,SoftDeletes;

    public function peserta()
    {
        return $this->belongsTo(peserta::class);
    }
}
