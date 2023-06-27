<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Appointment;
use App\Models\AppointmentType;
use Illuminate\Database\Seeder;

/**
 * php artisan db:seed --class=AppointmentSeeder
 */
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = AppointmentType::factory()
            ->count(10)
            ->create();
        $users = User::factory()
            ->count(1000)
            ->create();

        Appointment::factory()
            ->recycle($types)
            ->recycle($users)
            ->count(1000)
            ->create();
    }
}
