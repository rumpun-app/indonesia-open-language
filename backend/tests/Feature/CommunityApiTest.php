<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunityApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_post_comment_and_report(): void
    {
        $user = User::factory()->create();
        $post = $this->actingAs($user)->postJson('/api/v1/community/posts', ['title'=>'Banyumasan usage','body'=>'How is this word used?'])->assertCreated()->json();
        $this->actingAs($user)->postJson('/api/v1/community/posts/'.$post['id'].'/comments', ['body'=>'Native speakers use it informally.'])->assertCreated();
        $this->actingAs($user)->postJson('/api/v1/community/reports', ['reportable_type'=>'community_post','reportable_id'=>$post['id'],'reason'=>'spam'])->assertCreated()->assertJsonPath('status','open');
    }

    public function test_public_feed_only_returns_published_posts(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->postJson('/api/v1/community/posts', ['title'=>'Visible','body'=>'Body']);
        $this->assertDatabaseHas('community_posts', ['title'=>'Visible','status'=>'published']);
        $this->getJson('/api/v1/community/posts')->assertOk()->assertJsonCount(1,'data');
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
