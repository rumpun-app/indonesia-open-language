<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
        return ['slug' => ['required','alpha_dash','max:100','unique:languages,slug'], 'name' => ['required','string','max:150'], 'native_name' => ['nullable','string','max:150'], 'iso_code' => ['nullable','string','max:20'], 'description' => ['nullable','string'], 'status' => ['sometimes','in:draft,submitted,published'], 'metadata' => ['nullable','array']];
    }
}
