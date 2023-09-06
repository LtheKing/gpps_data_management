<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jemaat;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jemaat_id' => Jemaat::all()->random()->id,
            'tgl_kehadiran' => $this->faker->dateTimeThisYear(),
            'cabang_id' => $this->faker->numberBetween(1,3),
            'ibadah_ke' => $this->faker->numberBetween(1,3)
        ];
    }
}
