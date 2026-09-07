<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommunityPostRequest extends FormRequest
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
        return ['title'=>['required','string','max:255'],'body'=>['required','string'],'language_id'=>['nullable','exists:languages,id'],'dialect_id'=>['nullable','exists:dialects,id'],'target_type'=>['nullable','string','max:100'],'target_id'=>['nullable','string','max:100']];
    }
}
