<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class peserta extends Model
{
    use HasFactory,SoftDeletes;

    public function tender()
    {
        # code...
        return $this->belongsTo('App\Models\tender');
    }
    public function tender_file_detail()
    {
        # code...
        return $this->belongsTo('App\Models\tender_file_detail');
    }

    public function User()
    {
        # code...
        return $this->belongsTo(User::class);
    }
}
