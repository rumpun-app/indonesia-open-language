<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ReputationEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReputationAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_analytics_event_is_recorded_without_external_provider(): void
    {
        $this->postJson('/api/v1/analytics/events', ['event_name'=>'dictionary_viewed','anonymous_id'=>'anon-1','properties'=>['language'=>'jawa']])->assertCreated()->assertJsonPath('event_name','dictionary_viewed');
        $this->assertDatabaseHas('analytics_events',['event_name'=>'dictionary_viewed']);
    }

    public function test_user_reputation_is_aggregated_from_events(): void
    {
        $user=User::factory()->create(); ReputationEvent::create(['user_id'=>$user->id,'event_type'=>'accepted_contribution','points'=>15]); ReputationEvent::create(['user_id'=>$user->id,'event_type'=>'helpful_review','points'=>5]);
        $this->actingAs($user)->getJson('/api/v1/me/reputation')->assertOk()->assertJsonPath('points',20);
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
