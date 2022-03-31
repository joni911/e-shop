<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender_file extends Model
{
    use HasFactory;

    public function tender_file_detail()
    {
        # code...
        return $this->hasMany('App\Models\tender_file_detail');
    }

    public function tender()
    {
        # code...
        return $this->belongsTo('App\Models\tender');
    }
}
