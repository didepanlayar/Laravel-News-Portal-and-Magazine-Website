<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait UniqueTitleSlugTrait
{
    public function uniqueTitle(string $title, string $modelClass): string
    {
        $originalTitle = $title;
        $i = 1;

        while ($modelClass::where('title', $title)->exists()) {
            $title = $originalTitle . ' ' . $i;
            $i++;
        }

        return $title;
    }

    public function uniqueSlug(string $slug, string $modelClass): string
    {
        $originalSlug = $slug;
        $i = 1;

        while ($modelClass::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
