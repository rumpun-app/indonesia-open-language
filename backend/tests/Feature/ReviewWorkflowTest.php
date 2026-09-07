<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_reviewer_approval_advances_contribution(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class);
        $author = User::factory()->create();
        $reviewer = User::factory()->create();
        $reviewer->roles()->attach(Role::where('slug', 'reviewer')->first());
        $author->roles()->attach(Role::where('slug', 'contributor')->first());
        $contribution = $this->actingAs($author)->postJson('/api/v1/contributions', ['type' => 'add_word', 'change_set' => ['word' => 'mangan']])->json();
        $id = $contribution['id'];
        $this->actingAs($reviewer)->postJson('/api/v1/reviews', ['contribution_id' => $id, 'decision' => 'approve', 'reason' => 'Supported by native speaker evidence'])->assertCreated()->assertJsonPath('contribution.status', 'community_verified');
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
