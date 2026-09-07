<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;
use App\Models\Script;
use App\Models\GrammarRule;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinguisticsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_language_scripts_and_published_grammar_are_exposed(): void
    {
        $language=Language::factory()->create(['status'=>'published']); $script=Script::create(['slug'=>'latin','name'=>'Latin']); $language->scripts()->attach($script,['is_primary'=>true]);
        GrammarRule::create(['language_id'=>$language->id,'category'=>'syntax','title'=>'Word order','description'=>'Verb follows subject','status'=>'published']);
        $this->getJson('/api/v1/languages/'.$language->id.'/scripts')->assertOk()->assertJsonPath('0.slug','latin');
        $this->getJson('/api/v1/languages/'.$language->id.'/grammar')->assertOk()->assertJsonPath('data.0.title','Word order');
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
