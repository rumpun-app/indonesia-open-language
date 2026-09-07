<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use App\Models\Language;
use App\Models\Speaker;
use App\Models\Role;
use App\Models\User;
use App\Jobs\ProcessAudioRecording;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AudioWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributor_uploads_consenting_speaker_audio(): void
    {
        $this->seed(\Database\Seeders\RbacSeeder::class); Storage::fake('s3'); Queue::fake();
        $user = User::factory()->create(); $user->roles()->attach(Role::where('slug','contributor')->first());
        $speaker = Speaker::create(['user_id'=>$user->id,'display_name'=>'Native Speaker','consent_status'=>'approved','license'=>'CC-BY-4.0']);
        $language = Language::factory()->create();
        $response = $this->actingAs($user)->post('/api/v1/audio', ['speaker_id'=>$speaker->id,'language_id'=>$language->id,'text'=>'mangan','license'=>'CC-BY-4.0','audio'=>UploadedFile::fake()->create('mangan.wav',100,'audio/wav')]);
        $response->assertCreated()->assertJsonPath('data.processing_status','processing');
        Queue::assertPushed(ProcessAudioRecording::class);
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
