<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class peralatan extends Model
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
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
