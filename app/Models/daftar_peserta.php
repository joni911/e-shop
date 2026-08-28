<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class daftar_peserta extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'tender_id', 'peserta_id'];

    public function user()
    {
        # code...
        return $this->hasMany(user::class);
    }
    public function tender()
    {
        # code...
        return $this->belongsTo(tender::class);
    }
    public function peserta()
    {
        # code...
        return $this->belongsTo(peserta::class);
    }
}
