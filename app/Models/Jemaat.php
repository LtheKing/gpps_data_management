<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\Cabang;


class Jemaat extends Model
{
    use HasFactory;

    protected $fillable = [
        'NoAnggota', //a
        'Nama', //b
        'Alamat', //c
        'Tlp', //d
        'Status', //e
        'NamaAyah', //f
        'NamaIbu', //g
        'TanggalBaptis', //h
        'PelaksanaBaptis', //i
        'FileName', //j
        'ImageName', //k
        'JenisKelamin', //l
        'Segment', //m
        'StatusBaptis', //n
        'StatusKematian', //o
        'TanggalKematian', //p
        'NamaSuami', //q
        'NamaIstri', //r
        'TanggalPernikahan', //s
        'PelaksanaPemberkatan', //t
        'TempatLahir', //u
        'TanggalLahir', //v
        'GolonganDarah', //w
        'komisi', //x
        'cabang_id' //y
    ];

    public function cabang() {
        return $this->hasOne(Cabang::class);
    }
}
