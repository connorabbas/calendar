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
        $this->call([
            AppointmentTypeSeeder::class,
        ]);
        
        collect(range(0, 20))
            ->each(function () {
                User::factory()
                    ->has(
                        Appointment::factory()->recycle(AppointmentType::inRandomOrder()->get())->times(rand(1, 5)),
                        'appointments'
                    )
                    ->create();
            });
        
    }
}
