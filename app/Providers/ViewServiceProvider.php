<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Language;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share data for header component
        View::composer('frontend.layouts.header', function ($view) {
            $languages = Language::where('status', 1)->get();

            $view->with('languages', $languages);
        });
    }

    public function register()
    {
        //
    }
}
