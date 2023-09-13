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
        'komisi',
        'cabang_id'
    ];

    public function cabang() {
        return $this->hasOne(Cabang::class);
    }
}
