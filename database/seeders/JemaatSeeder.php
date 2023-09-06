<?php

namespace Database\Seeders;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class JemaatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 100; $i++) {
            // insert data ke table jemaats menggunakan Faker
            DB::table('jemaats')->insert([
                'NoAnggota' => $faker->randomDigit,
                'Nama' => $faker->name,
                'Alamat' => $faker->address,
                'Tlp' => $faker->numberBetween(8000,9000),
                'Status' => $faker->randomElement(['Menikah' ,'Belum Menikah']),
                'NamaAyah' => $faker->name,
                'NamaIbu' => $faker->name,
                'TanggalBaptis' => $faker->dateTime,
                'PelaksanaBaptis' => $faker->name,
                'FileName' => $faker->imageUrl($width = 640, $height = 480),
                'ImageName' => $faker->imageUrl($width = 640, $height = 480),
                'Segment' => $faker->randomElement(['Anak' ,'Remaja', 'Dewasa']),
                'StatusKematian' => $faker->randomElement(['Ya' ,'Tidak']),
                'TanggalKematian' => $faker->date,
                'StatusBaptis' => $faker->randomElement(['Sudah' ,'Belum']),
                'JenisKelamin' => $faker->randomElement(['Wanita' ,'Pria']),
                'TempatLahir' => $faker->address,
                'TanggalLahir' => $faker->date,
                'GolonganDarah' => $faker->randomElement(['A' ,'B', 'AB', 'O']),
                'NamaIstri' => $faker->randomElement(['-']),
                'NamaSuami' => $faker->randomElement(['-']),
                'TanggalPernikahan' => $faker->date,
                'PelaksanaPemberkatan' => $faker->name,
                'komisi' => $faker->randomElement(['Pemuda', 'Anak']),
            ]);

            //update komisi data
            // DB::table('jemaats')->update([
            //     'komisi' => $faker->randomElement(['Pemuda', 'Anak']),
            // ]);

        }
    }
}
