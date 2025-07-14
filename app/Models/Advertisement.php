<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_top_ad_url',
        'home_top_ad_image',
        'home_top_ad_status',
        'home_bottom_ad_url',
        'home_bottom_ad_image',
        'home_bottom_ad_status',
        'archive_bottom_ad_url',
        'archive_bottom_ad_image',
        'archive_bottom_ad_status',
        'news_bottom_ad_url',
        'news_bottom_ad_image',
        'news_bottom_ad_status',
        'sidebar_ad_url',
        'sidebar_ad_image',
        'sidebar_ad_status',
    ];
}
