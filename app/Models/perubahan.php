<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class perubahan extends Model
{
    use HasFactory,SoftDeletes;

    public function tahapan()
    {
        return $this->belongsTo('App\Models\tahapan');
    }
}
