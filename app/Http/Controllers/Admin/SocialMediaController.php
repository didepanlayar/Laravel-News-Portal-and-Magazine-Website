<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialMediaStoreRequest;
use App\Http\Requests\Admin\SocialMediaUpdateRequest;
use App\Models\Language;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Social,admin'])->only('index');
        $this->middleware(['permission:Create Social,admin'])->only('create', 'store');
        $this->middleware(['permission:Update Social,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete Social,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        $dataByLang = [];

        foreach ($languages as $language) {
            $dataByLang[$language->language] = SocialMedia::where('language', $language->language)->get();
        }

        $title = 'Delete Social Media!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.social-media.index', compact('languages', 'dataByLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.social-media.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialMediaStoreRequest $request)
    {
        $socialMedia = new SocialMedia();
        $socialMedia->name = $request->name;
        $socialMedia->icon = $request->icon;
        $socialMedia->count = $request->count;
        $socialMedia->type = $request->type;
        $socialMedia->title = $request->title;
        $socialMedia->color = $request->color;
        $socialMedia->url = $request->url;
        $socialMedia->language = $request->language;
        $socialMedia->status = $request->status;
        $socialMedia->save();

        toast(__('Social Media created successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.social-media.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all();
        $socialMedia = SocialMedia::findOrFail($id);

        return view('admin.social-media.edit', compact('languages', 'socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialMediaUpdateRequest $request, string $id)
    {
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->name = $request->name;
        $socialMedia->icon = $request->icon;
        $socialMedia->count = $request->count;
        $socialMedia->type = $request->type;
        $socialMedia->title = $request->title;
        $socialMedia->color = $request->color;
        $socialMedia->url = $request->url;
        $socialMedia->language = $request->language;
        $socialMedia->status = $request->status;
        $socialMedia->save();

        toast(__('Social Media updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.social-media.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $socialMedia = SocialMedia::findOrFail($id);
            $socialMedia->delete();

            toast(__('Social Media deleted successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('Social Media deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.social-media.index');
    }
}
