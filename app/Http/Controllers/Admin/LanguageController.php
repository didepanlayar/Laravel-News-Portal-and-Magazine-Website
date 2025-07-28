<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageStoreRequest;
use App\Http\Requests\Admin\LanguageUpdateRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Language,admin'])->only('index');
        $this->middleware(['permission:Create Language,admin'])->only('create', 'store');
        $this->middleware(['permission:Update Language,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete Language,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        $title = 'Delete Language!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageStoreRequest $request)
    {
        $language = new Language();
        $language->name = $request->name;
        $language->language = $request->language;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;
        $language->save();

        toast(__('backend.Language create successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.languages.index');
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
        $language = Language::findOrFail($id);

        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageUpdateRequest $request, string $id)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->language = $request->language;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;
        $language->save();

        toast(__('backend.Language update successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $language = Language::findOrFail($id);

            if($language->language == 'en') {
                toast(__('backend.Default language cannot be deleted'), 'error')->width('350')->timerProgressBar();
            } else {
                $language->delete();

                toast(__('backend.Language delete successfully'), 'success')->width('350')->timerProgressBar();
            }
        } catch (\Throwable $th) {
            toast(__('backend.Language delete error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.languages.index');
    }
}
