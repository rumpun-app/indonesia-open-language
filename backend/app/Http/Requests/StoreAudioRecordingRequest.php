<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAudioRecordingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermission('audio.upload');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['speaker_id'=>['required','exists:speakers,id'], 'language_id'=>['required','exists:languages,id'], 'dialect_id'=>['nullable','exists:dialects,id'], 'text'=>['nullable','string'], 'audio'=>['required','file','mimes:mp3,wav,ogg,m4a','max:51200'], 'license'=>['required','string','max:100'], 'recorded_at'=>['nullable','date']];
    }
}
