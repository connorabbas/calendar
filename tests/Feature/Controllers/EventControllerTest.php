<?php

namespace Tests\Feature\Controllers;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\EventType;
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

    public function test_store_returns_302_when_logged_out(): void
    {
        $this->post(route('events.store'))->assertStatus(302);
    }

    public function test_store_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $eventType = EventType::factory()->create();
        $start = Carbon::now();
        $finish = Carbon::now()->addHour();

        $this->actingAs($user);
        $this->post(route('events.store'), [
            'start_time' => $start,
            'finish_time' => $finish,
            'event_type_id' => $eventType->id,
            'comments' => 'testing'
        ])->assertStatus(200);
    }

    public function test_store_throws_error_when_start_is_after_finish(): void
    {
        $user = User::factory()->create();
        $eventType = EventType::factory()->create();
        $start = Carbon::now()->addHour();
        $finish = Carbon::now();

        $this->actingAs($user);
        $this->post(route('events.store'), [
            'start_time' => $start,
            'finish_time' => $finish,
            'event_type_id' => $eventType->id,
            'comments' => 'testing'
        ])
            ->assertSessionHasErrors([
                'finish_time'
            ]);
    }

    public function test_update_returns_302_when_logged_out(): void
    {
        $this->patch(route('events.update', ['id' => 123]))->assertStatus(302);
    }

    // TODO: assert different data
    public function test_update_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'user_id' => $user->id
        ]);
        $start = Carbon::now();
        $finish = Carbon::now()->addHour();

        $this->actingAs($user);
        $this->patch(route('events.update', ['id' => $event->id]), [
            'start_time' => $start,
            'finish_time' => $finish,
            'event_type_id' => $event->type->id,
            'comments' => 'testing'
        ])->assertStatus(200);
    }
}
