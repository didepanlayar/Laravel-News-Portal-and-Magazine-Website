<?php

namespace App\Providers;

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

            $view->with('languages', $languages);
            $view->with('platforms', $platforms);
        });
    }

    public function register()
    {
        //
    }
}
