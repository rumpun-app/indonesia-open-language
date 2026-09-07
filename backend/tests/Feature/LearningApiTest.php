<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LearningApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_record_completed_lesson_progress(): void
    {
        $course = Course::create(['slug'=>'jawa-dasar','title'=>'Jawa Dasar','status'=>'published']);
        $lesson = $course->lessons()->create(['position'=>1,'title'=>'Salam','content'=>'Sugeng enjing']);
        $user = User::factory()->create();
        $this->actingAs($user)->postJson('/api/v1/me/progress', ['course_id'=>$course->id,'lesson_id'=>$lesson->id,'xp'=>25,'completed'=>true])->assertOk()->assertJsonPath('xp',25)->assertJsonPath('streak',1);
        $this->actingAs($user)->getJson('/api/v1/me/progress')->assertOk()->assertJsonCount(1);
    }

    public function test_published_course_detail_contains_lessons(): void
    {
        $course = Course::create(['slug'=>'sunda-dasar','title'=>'Sunda Dasar','status'=>'published']); $course->lessons()->create(['position'=>1,'title'=>'Perkenalan']);
        $this->getJson('/api/v1/courses/'.$course->id)->assertOk()->assertJsonPath('data.lessons.0.title','Perkenalan');
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
