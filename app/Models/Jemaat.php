<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    protected $fillable = [
        'NoAnggota',
        'Nama',
        'Alamat',
        'Tlp',
        'Status',
        'NamaAyah',
        'NamaIbu',
        'TanggalBaptis',
        'PelaksanaBaptis',
        'FileName',
        'ImageName',
        'JenisKelamin',
        'Segment',
        'StatusBaptis',
        'StatusKematian',
        'TanggalKematian',
        'NamaSuami',
        'NamaIstri',
        'TanggalPernikahan',
        'PelaksanaPemberkatan',
        'TempatLahir',
        'TanggalLahir',
        'GolonganDarah',
    ];
}
