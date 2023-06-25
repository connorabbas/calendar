<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Appointment;
use App\Models\AppointmentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = AppointmentType::factory()
            ->count(5)
            ->create();

        $users = User::factory()
            ->count(10)
            ->create();

        Appointment::factory()
            ->recycle($types)
            ->recycle($users)
            ->count(30)
            ->create();  
    }
}
