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
        return $this->hasMany(tender_file_detail::class);
    }

    public function tender()
    {
        # code...
        return $this->belongsTo(tender::class);
    }
}
