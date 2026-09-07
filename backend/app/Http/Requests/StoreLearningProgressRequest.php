<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLearningProgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['course_id'=>['required','exists:courses,id'],'lesson_id'=>['required','exists:lessons,id'],'xp'=>['sometimes','integer','min:0','max:1000'],'completed'=>['sometimes','boolean']];
    }
}
