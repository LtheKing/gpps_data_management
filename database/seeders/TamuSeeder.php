<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class TamuSeeder extends Seeder
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
            DB::table('tamu')->insert([
                'NamaTamu' => $faker->name,
                'Alias' => $faker->randomElement(['tamu' . $i]),
                'Alamat' => $faker->address,
                'NoTelp' => $faker->numberBetween(8000, 9000),
                'Email' => $faker->email,
                'cabang_id' => $faker->numberBetween(1, 3),
                'IbadahKe' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
