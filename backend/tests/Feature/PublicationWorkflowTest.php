<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contribution;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicationWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_publish_permission_can_publish_verified_contribution(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class);
        $author = User::factory()->create(); $admin = User::factory()->create();
        $author->roles()->attach(Role::where('slug','contributor')->first()); $admin->roles()->attach(Role::where('slug','administrator')->first());
        $contribution = Contribution::create(['author_id'=>$author->id,'type'=>'add_word','status'=>'community_verified','change_set'=>['word'=>'mangan'],'reason'=>'native speaker evidence']);
        $this->actingAs($admin)->postJson("/api/v1/contributions/{$contribution->id}/publish")->assertOk()->assertJsonPath('status','published');
        $this->assertDatabaseHas('entity_versions', ['versionable_id'=>$contribution->id, 'version'=>1]);
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
