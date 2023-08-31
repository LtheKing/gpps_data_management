<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jemaat;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'jemaat_id',
        'tgl_kehadiran',
        'cabang_id',
        'ibadah_ke'
    ];

    public $timestamps = false;


    public function comments() {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
}
