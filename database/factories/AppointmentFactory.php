<?php

namespace Database\Factories;

use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-2 week', '+2 week');
        $hoursOff = fake()->numberBetween(0, 8);
        $finishDate = (clone $startDate)->add(new DateInterval("PT{$hoursOff}H"));

        return [
            'user_id' => fake()->randomNumber(3),
            'appointment_type_id' => fake()->randomNumber(1),
            'start_time' => $startDate,
            'finish_time' => $finishDate,
            'comments' => fake()->paragraph()
        ];
    }
}
