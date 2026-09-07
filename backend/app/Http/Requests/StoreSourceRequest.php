<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSourceRequest extends FormRequest
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
        return ['type'=>['required','in:community,native_speaker,book,dictionary,research_paper,local_institution,university,government_resource,field_recording,website,other'], 'title'=>['required','string','max:255'], 'author'=>['nullable','string','max:255'], 'url'=>['nullable','url'], 'citation'=>['nullable','string'], 'license'=>['nullable','string','max:100'], 'notes'=>['nullable','string'], 'metadata'=>['nullable','array']];
    }
}
