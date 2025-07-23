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
function truncate(?string $text, int $limit = 50): string
{
    return Str::limit($text ?? '', $limit, '...');
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

/**
 * Make menu active
 */
function activeMenu(array $routes): string
{
    foreach($routes as $route) {
        if(request()->routeIs($route)) {
            return 'active';
        }
    }

    return '';
}

/**
 * Check role and permission
 */
function canAccess(array $permissions)
{
    $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
    $administrator = auth()->guard('admin')->user()->hasRole('Administrator');

    if($permission || $administrator) {
        return true;
    } else {
        return false;
    }
}

/**
 * Get User Role
 */
function getRole()
{
    $role = auth()->guard('admin')->user()->getRoleNames();
    return $role->first();
}

/**
 * Check User Permission
 */
function checkPermission(string $permission)
{
    return auth()->guard('admin')->user()->hasPermissionTo($permission);
}
