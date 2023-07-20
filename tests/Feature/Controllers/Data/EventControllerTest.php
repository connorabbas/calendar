<?php

namespace Tests\Feature\Controllers\Data;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_search_returns_302_when_logged_out(): void
    {
        $this->get(route('data.events.search'))->assertStatus(302);
    }

    public function test_search_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get(route('data.events.search'))->assertStatus(200);
    }

    public function test_get_returns_302_when_logged_out()
    {
        $this->get(route('data.events.single', ['event' => 1]))->assertStatus(302);
    }

    public function test_get_returns_403_when_different_user()
    {
        $user = User::factory()->create();
        $differentUser = User::factory()->create();
        $event = Event::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($differentUser);
        $this->get(route('data.events.single', ['event' => $event->id]))->assertStatus(403);
    }

    public function test_get_returns_200_with_correct_user()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user);
        $this->get(route('data.events.single', ['event' => $event->id]))->assertStatus(200);
    }
}
