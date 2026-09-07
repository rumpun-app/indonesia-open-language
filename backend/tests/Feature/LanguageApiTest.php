<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;
use App\Models\User;
use Tests\TestCase;

class LanguageApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_published_languages_are_listed(): void
    {
        Language::factory()->create(['name' => 'Bahasa Jawa', 'slug' => 'jawa']);
        Language::factory()->create(['name' => 'Draft Language', 'status' => 'draft']);

        $response = $this->getJson('/api/v1/languages');

        $response->assertOk()->assertJsonPath('data.0.slug', 'jawa');
    }

    public function test_authenticated_user_can_create_language(): void
    {
        $response = $this->actingAs(User::factory()->create())->postJson('/api/v1/languages', [
            'slug' => 'sunda', 'name' => 'Bahasa Sunda', 'native_name' => 'Basa Sunda',
        ]);

        $response->assertCreated()->assertJsonPath('data.slug', 'sunda');
        $this->assertDatabaseHas('languages', ['slug' => 'sunda', 'status' => 'draft']);
    }

    public function test_guest_cannot_create_language(): void
    {
        $this->postJson('/api/v1/languages', [])->assertUnauthorized();
    }
}
