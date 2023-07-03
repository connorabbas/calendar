<?php

namespace Tests\Feature\Controllers;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\EventType;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventControllerTest extends TestCase
{
    use DatabaseTransactions;

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

    public function test_store_returns_200_when_logged_in(): void
    {
        $user = User::factory()->create();
        $eventType = EventType::factory()->create();
        $start = Carbon::now()->toDateTimeString();
        $finish = Carbon::now()->addHour()->toDateTimeString();

        $this->actingAs($user);
        $this->post(route('events.store'), [
            'start_time' => $start,
            'finish_time' => $finish,
            'event_type_id' => $eventType->id,
            'comments' => 'testing'
        ])->assertStatus(200);
    }
}
