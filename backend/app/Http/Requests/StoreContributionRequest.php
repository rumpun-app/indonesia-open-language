<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermission('contribution.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['type' => ['required','in:add_word,add_phrase,add_translation,add_example,add_audio,correction,add_dialect,add_script,add_culture'], 'target_type' => ['nullable','string','max:100'], 'target_id' => ['nullable','string','max:100'], 'change_set' => ['required','array'], 'reason' => ['nullable','string'], 'evidence' => ['nullable','array']];
    }
}
