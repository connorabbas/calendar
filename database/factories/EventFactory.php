<?php

namespace Database\Factories;

use DateInterval;
use App\Models\User;
use App\Models\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', '+1 year');
        $hoursOff = fake()->numberBetween(0, 8);
        $finishDate = (clone $startDate)->add(new DateInterval("PT{$hoursOff}H"));

        return [
            'user_id' => User::factory(),
            'event_type_id' => EventType::factory(),
            'start_time' => $startDate,
            'finish_time' => $finishDate,
            'comments' => fake()->paragraph()
        ];
    }
}
