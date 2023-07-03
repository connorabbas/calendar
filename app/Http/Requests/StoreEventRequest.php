<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_time' => ['required', 'date'],
            'finish_time' => ['required', 'date'],
            'event_type_id' => ['required', 'numeric', 'exists:event_types'],
            'comments' => ['nullable', 'string'],
        ];
    }
}
