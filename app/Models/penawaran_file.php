<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penawaran_file extends Model
{
    use HasFactory, SoftDeletes;

    public function penawaran()
    {
        # code...
        return $this->hasMany(penawaran::class);
    }
}
