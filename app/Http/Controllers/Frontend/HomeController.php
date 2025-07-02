<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Index view
     */
    public function index()
    {
        $breakingNews = News::where(['is_breaking' => 1])
            ->activeEntries()->withLocalize()->latest('id')->take(9)->get();

        return view('frontend.home', compact('breakingNews'));
    }
}
