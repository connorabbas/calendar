<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Database\Seeder;

/**
 * php artisan db:seed --class=EventSeeder
 */
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = EventType::factory()
            ->count(10)
            ->create();
        $users = User::factory()
            ->count(1000)
            ->create();

        Event::factory()
            ->recycle($types)
            ->recycle($users)
            ->count(1000)
            ->create();
    }
}
