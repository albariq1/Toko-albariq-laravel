<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relasi ke tabel users => ELOQUENT
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //relasi ke tabel pelanggang => ELOQUENT
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
