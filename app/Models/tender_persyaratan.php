<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender_persyaratan extends Model
{
    use HasFactory,SoftDeletes;

    public function tender_persyaratan_file()
    {
        # code...
        return $this->hasMany(tender_persyaratan_file::class);
    }

    public function tender()
    {
        # code...
        return $this->belongsTo(tender::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}

