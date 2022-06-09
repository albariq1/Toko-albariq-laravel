<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // field yang tidak masuk dalam $guarded adalah field2 yang bisa diinput dari luar
    // 
    protected $guarded = ['id'];
}
