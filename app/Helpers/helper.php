<?php

use App\Models\Language;
use Illuminate\Support\Str;

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

/**
 * Truncate text
 */
function truncate(string $text, int $limit = 50): string
{
    return Str::limit($text, $limit, '...');
}

/**
 * Convert a number for Viewed
 */
function ConvertViewed(int $number): string
{
    if ($number < 1000) {
        return $number;
    } elseif ($number < 1000000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return round($number / 1000000, 1) . 'M';
    }
}
