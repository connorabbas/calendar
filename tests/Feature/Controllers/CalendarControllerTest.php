<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalendarControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get(route('calendar'))->assertStatus(200);
    }

    public function test_index_returns_302_when_logged_out(): void
    {
        $this->get(route('calendar'))->assertStatus(302);
    }
}
