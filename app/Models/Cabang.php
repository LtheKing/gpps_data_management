<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'NamaCabang',
        'Alamat',
        'Status'
    ];

    public function cabangs() {
        return $this->hasMany(User::class);
    }
}
