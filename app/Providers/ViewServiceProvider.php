<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Language;
use App\Models\SocialPlatform;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share data for app layouts
        View::composer('frontend.layouts.app', function ($view) {
            $languages = Language::where('status', 1)->get();
            $platforms = SocialPlatform::where('status', 1)->get();
            $categories = Category::where(['status' => 1, 'display' => 1, 'language' => getLanguage()])->get();

            $view->with('languages', $languages);
            $view->with('platforms', $platforms);
            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
