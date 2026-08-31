<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanggah extends Model
{
    use HasFactory;

    protected $fillable = ['peserta_id', 'tender_id', 'user_id', 'keterangan', 'file'];

    public function peserta()
    {
        return $this->belongsTo(peserta::class);
    }

    public function tender()
    {
        return $this->belongsTo(tender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
