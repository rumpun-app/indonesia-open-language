<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContributionWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributor_can_submit_contribution(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('slug', 'contributor')->first());

        $create = $this->actingAs($user)->postJson('/api/v1/contributions', [
            'type' => 'add_word', 'change_set' => ['word' => 'mangan', 'meaning' => 'eat'],
        ])->assertCreated();

        $id = $create->json('id') ?: $create->json('data.id');
        $this->actingAs($user)->postJson("/api/v1/contributions/{$id}/submit")
            ->assertOk()->assertJsonPath('status', 'submitted');
    }

    public function test_learner_cannot_create_contribution(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('slug', 'learner')->first());
        $this->actingAs($user)->postJson('/api/v1/contributions', [
            'type' => 'add_word', 'change_set' => ['word' => 'mangan'],
        ])->assertForbidden();
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
