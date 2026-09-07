<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExportApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_supports_jsonl_and_csv(): void
    {
        Language::factory()->create(['slug'=>'jawa','status'=>'published']);
        $this->get('/api/v1/exports/languages?format=jsonl')->assertOk()->assertHeader('Content-Type','application/x-ndjson');
        $this->get('/api/v1/exports/languages?format=csv')->assertOk()->assertHeader('Content-Type','text/csv; charset=UTF-8')->assertSee('language');
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
