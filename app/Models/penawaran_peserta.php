<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penawaran_peserta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'tender_id',
        'peserta_id',
        'penawaran',
        'koreksi',
    ];

    public function penawaran()
    {
        # code...
        return $this->belongsTo(penawaran::class);
    }

    public function penawaran_peserta_file()
    {
        # code...
        return $this->hasMany(penawaran_peserta_file::class);

    }

    public function peserta()
    {
        # code...
        return $this->hasMany(peserta::class);
    }
}
