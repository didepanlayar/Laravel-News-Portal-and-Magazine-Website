<?php

use App\Models\Language;

/**
 * Format News Tags
 */
function formatTags(array $tags): String
{
    return implode(',', $tags);
}

/**
 * Get selected language from session
 */
function getLanguage(): string
{
    if(session()->has('language')) {
        return session('language');
    } else {
        $language = Language::where('default', 1)->first();

        try {
            setLanguage($language->language);
            return $language->language;
        } catch (\Throwable $th) {
            setLanguage('en');
            return $language->language;
        }
    }
}

/**
 * Set selected language from session
 */
function setLanguage(string $code)
{
    session(['language' => $code]);
}
