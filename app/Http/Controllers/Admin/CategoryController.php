<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        $categoriesByLang = [];

        foreach ($languages as $language) {
            $categoriesByLang[$language->language] = Category::where('language', $language->language)->orderByDesc('id')->get();
        }

        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.categories.index', compact('languages', 'categoriesByLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.categories.create', compact('languages',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->language = $request->language;
        $category->slug = Str::slug($request->name);
        $category->display = $request->display;
        $category->status = $request->status;
        $category->save();

        toast(__('Category created successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.categories.index');
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
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('languages', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->language = $request->language;
        $category->slug = Str::slug($request->name);
        $category->display = $request->display;
        $category->status = $request->status;
        $category->save();

        toast(__('Category updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            toast(__('Category deleted successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('Category deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.categories.index');
    }
}
