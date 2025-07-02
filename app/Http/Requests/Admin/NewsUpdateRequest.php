<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
        $newsId = $this->route('news');

        return [
            'title' => ['required', 'string', 'max:255', 'unique:news,title,' . $newsId],
            'slug' => ['nullable', 'max:255', 'unique:news,slug,' . $newsId],
            'content' => ['nullable', 'string'],
            'image' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,webp'],
            'language' => ['required'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string', 'regex:/^([a-zA-Z0-9\s-]{1,20})(,\s*[a-zA-Z0-9\s-]{1,20}){0,9}$/'],  // Max: 10 Tags and 20 Character
            'is_breaking' => ['boolean'],
            'is_slider' => ['boolean'],
            'is_popular' => ['boolean'],
            'status' => ['boolean'],
            'category' => ['required'],
        ];
    }
}
