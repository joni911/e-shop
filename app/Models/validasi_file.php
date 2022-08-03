<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class validasi_file extends Model
{
    use HasFactory,SoftDeletes;

    public function tender_file_detail()
    {
        return $this->belongsTo(tender_file_detail::class);
    }
}
