<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

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
        for($i = 1; $i <= 100; $i++){
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
            ]);
        }
    }
}
