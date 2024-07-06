<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addMonths(3);

        // return [
        //     'patient_id' => $this->faker->numberBetween(1, \App\Models\Patient::count()),
        //     'date' => $this->faker->dateTimeBetween($startDate, $endDate),
        //     'status' => $this->faker->randomElement(['en cours', 'reprogrammer', 'cloturer']),
        //     'is_deleted' => $this->faker->randomElement([false,true]),
        //     //
        // ];

        return false;
    }
}
