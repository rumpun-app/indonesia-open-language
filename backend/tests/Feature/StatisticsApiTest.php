<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;
use App\Models\LexicalEntry;
use App\Models\Role;
use App\Models\User;
use App\Models\Contribution;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatisticsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_language_statistics_count_published_data(): void
    {
        $language=Language::factory()->create(['status'=>'published']); LexicalEntry::create(['language_id'=>$language->id,'status'=>'published']);
        $this->getJson('/api/v1/languages/'.$language->id.'/statistics')->assertOk()->assertJsonPath('published_entries',1);
    }

    public function test_admin_statistics_requires_permission(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class); $admin=User::factory()->create(); $admin->roles()->attach(Role::where('slug','administrator')->first());
        Contribution::create(['author_id'=>$admin->id,'type'=>'add_word','status'=>'submitted','change_set'=>['word'=>'x']]);
        $this->actingAs($admin)->getJson('/api/v1/admin/statistics')->assertOk()->assertJsonPath('pending_contributions',1);
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
