<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLexicalEntryRequest extends FormRequest
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
        return ['language_id'=>['required','exists:languages,id'], 'dialect_id'=>['nullable','exists:dialects,id'], 'region_id'=>['nullable','exists:regions,id'], 'part_of_speech'=>['nullable','string','max:50'], 'register'=>['nullable','string','max:50'], 'notes'=>['nullable','string'], 'word_forms'=>['required','array','min:1'], 'word_forms.*.form'=>['required','string','max:255'], 'word_forms.*.script'=>['nullable','string','max:50'], 'word_forms.*.pronunciation'=>['nullable','string','max:255'], 'word_forms.*.is_lemma'=>['boolean'], 'senses'=>['required','array','min:1'], 'senses.*.position'=>['integer','min:1'], 'senses.*.definition'=>['required','string'], 'senses.*.translation'=>['nullable','string'], 'senses.*.register'=>['nullable','string','max:50'], 'senses.*.notes'=>['nullable','string']];
    }
}
