<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tender_file_detail extends Model
{
    use HasFactory,SoftDeletes;

    public function tender_file()
    {
        # code...
        return $this->belongsTo('App\Models\tender_file');
    }
}
