<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_contribution_actions_create_audit_entries(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class); $user=User::factory()->create(); $user->roles()->attach(Role::where('slug','contributor')->first());
        $response=$this->actingAs($user)->postJson('/api/v1/contributions',['type'=>'add_word','change_set'=>['word'=>'mangan']])->assertCreated(); $id=$response->json('id');
        $this->actingAs($user)->postJson('/api/v1/contributions/'.$id.'/submit')->assertOk();
        $this->assertDatabaseHas('audit_logs',['action'=>'contribution.created']); $this->assertDatabaseHas('audit_logs',['action'=>'contribution.submitted']);
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
