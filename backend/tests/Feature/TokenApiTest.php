<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TokenApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_list_and_revoke_api_token(): void
    {
        $user=User::factory()->create();
        $created=$this->actingAs($user)->postJson('/api/v1/tokens',['name'=>'SDK','abilities'=>['read','contribute']])->assertCreated()->assertJsonPath('abilities.0','read');
        $this->actingAs($user)->getJson('/api/v1/tokens')->assertOk()->assertJsonCount(1);
        $id=$user->tokens()->first()->id; $this->actingAs($user)->deleteJson('/api/v1/tokens/'.$id)->assertNoContent();
        $this->assertDatabaseMissing('personal_access_tokens',['id'=>$id]);
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
