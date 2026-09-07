<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLearningProgressRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\LearningProgress;

class LearningController extends Controller
{
    public function show(Course $course): CourseResource { abort_unless($course->status === 'published',404); return new CourseResource($course->load('lessons')); }

    public function progress(StoreLearningProgressRequest $request)
    {
        $data = $request->validated(); $lesson = \App\Models\Lesson::where('id',$data['lesson_id'])->where('course_id',$data['course_id'])->firstOrFail();
        $progress = LearningProgress::firstOrNew(['user_id'=>$request->user()->id,'course_id'=>$data['course_id'],'lesson_id'=>$lesson->id]);
        $progress->xp = max($progress->xp ?? 0, $data['xp'] ?? 0); $progress->streak = ($data['completed'] ?? false) ? ($progress->streak + 1) : $progress->streak; if ($data['completed'] ?? false) $progress->completed_at = now(); $progress->save();
        return response()->json($progress);
    }

    public function myProgress(Request $request) { return response()->json(LearningProgress::where('user_id',$request->user()->id)->latest()->get()); }
}
