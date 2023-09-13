<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'NamaTamu',
        'Alias',
        'Alamat',
        'NoTelp',
        'Email',
        'cabang_id',
        'IbadahKe'
    ];

    protected $table = 'tamu';
}
