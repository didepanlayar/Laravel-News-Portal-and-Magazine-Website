<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementUpdateRequest extends FormRequest
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
            'home_top_ad_url' => ['nullable', 'url'],
            'home_top_ad_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'home_top_ad_status' => ['boolean'],
            'home_bottom_ad_url' => ['nullable', 'url'],
            'home_bottom_ad_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'home_bottom_ad_status' => ['boolean'],
            'archive_bottom_ad_url' => ['nullable', 'url'],
            'archive_bottom_ad_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'archive_bottom_ad_status' => ['boolean'],
            'news_bottom_ad_url' => ['nullable', 'url'],
            'news_bottom_ad_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'news_bottom_ad_status' => ['boolean'],
            'sidebar_ad_url' => ['nullable', 'url'],
            'sidebar_ad_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'sidebar_ad_status' => ['boolean'],
        ];
    }
}
