<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_returns_302_when_logged_out(): void
    {
        $this->get(route('events.search'))->assertStatus(302);
    }

    public function test_search_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get(route('events.search'))->assertStatus(200);
    }
}
