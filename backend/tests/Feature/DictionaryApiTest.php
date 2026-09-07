<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;
use App\Models\LexicalEntry;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DictionaryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_dictionary_returns_multiple_senses_and_word_forms(): void
    {
        $language = Language::factory()->create(['status' => 'published']);
        $entry = LexicalEntry::create(['language_id'=>$language->id, 'status'=>'published', 'part_of_speech'=>'verb']);
        $entry->wordForms()->create(['form'=>'mangan','is_lemma'=>true]);
        $entry->senses()->createMany([['position'=>1,'definition'=>'to eat','translation'=>'eat'],['position'=>2,'definition'=>'to consume','translation'=>'consume']]);
        $this->getJson('/api/v1/dictionary?q=mangan')->assertOk()->assertJsonCount(2, 'data.0.senses');
    }

    public function test_contributor_can_create_structured_entry(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class);
        $user = User::factory()->create(); $user->roles()->attach(Role::where('slug','contributor')->first());
        $language = Language::factory()->create();
        $this->actingAs($user)->postJson('/api/v1/dictionary', ['language_id'=>$language->id, 'word_forms'=>[['form'=>'mangan','is_lemma'=>true]], 'senses'=>[['definition'=>'to eat']]])->assertCreated()->assertJsonPath('data.status','draft');
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
