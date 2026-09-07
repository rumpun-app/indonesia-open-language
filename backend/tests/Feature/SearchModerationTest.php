<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CommunityPost;
use App\Models\ContentReport;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchModerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_returns_cross_domain_results(): void
    {
        $user=User::factory()->create(); CommunityPost::create(['author_id'=>$user->id,'title'=>'Basa Jawa','body'=>'Diskusi bahasa','status'=>'published']);
        $this->getJson('/api/v1/search?q=Jawa')->assertOk()->assertJsonPath('query','Jawa')->assertJsonCount(1,'community');
    }

    public function test_moderator_can_resolve_report(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class); $user=User::factory()->create(); $moderator=User::factory()->create(); $moderator->roles()->attach(Role::where('slug','administrator')->first());
        $report=ContentReport::create(['reporter_id'=>$user->id,'reportable_type'=>'community_post','reportable_id'=>'x','reason'=>'spam','status'=>'open']);
        $this->actingAs($moderator)->postJson('/api/v1/moderation/reports/'.$report->id.'/resolve',['status'=>'dismissed','resolution'=>'Reviewed and dismissed'])->assertOk()->assertJsonPath('status','dismissed');
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
