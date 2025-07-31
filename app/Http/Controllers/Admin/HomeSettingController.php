<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSettingUpdateRequest;
use App\Models\Category;
use App\Models\HomeSetting;
use App\Models\Language;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Home,admin'])->only('index');
        $this->middleware(['permission:Update Home,admin'])->only('update');
    }

    /**
     * Index view
     */
    public function index() {
        $languages = Language::all();
        $categoriesByLang = [];
        $homeSetting = [];

        foreach ($languages as $language) {
            $categoriesByLang[$language->language] = Category::where('language', $language->language)->orderByDesc('id')->get();
            $homeSetting[$language->language] = HomeSetting::where('language', $language->language)->first();
        }

        return view('admin.settings.home', compact('languages', 'categoriesByLang', 'homeSetting'));
    }

    /**
     * Update home setting
     */
    public function update(HomeSettingUpdateRequest $request) {
        HomeSetting::updateOrCreate(
            ['language' => $request->language],
            [
                'category_section_1' => $request->category_section_1,
                'category_section_2' => $request->category_section_2,
                'category_section_3' => $request->category_section_3,
                'category_section_4' => $request->category_section_4,
            ]
        );

        toast(__('backend.Home updated successfully'), 'success')->width('350')->timerProgressBar();

        session(['active_tab' => $request->language]);

        return redirect()->back();
    }
}
