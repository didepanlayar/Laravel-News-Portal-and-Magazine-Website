<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
            'count' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
            'language' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ];
    }
}
