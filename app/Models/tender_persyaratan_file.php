<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender_persyaratan_file extends Model
{
    use HasFactory, SoftDeletes;

    public function tender_persyaratan()
    {
        # code...
        return $this->belongsTo(tender_persyaratan::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
