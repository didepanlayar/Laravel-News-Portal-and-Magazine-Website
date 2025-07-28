<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Http\Requests\Admin\NewsUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use App\Traits\UniqueTitleSlugTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    use FileUploadTrait;
    use UniqueTitleSlugTrait;
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read News,admin'])->only('index', 'duplicate');
        $this->middleware(['permission:Create News,admin'])->only('create', 'store');
        $this->middleware(['permission:Update News,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete News,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        $newsByLang = [];

        foreach ($languages as $language) {
            if (canAccess(['Access News'])) {
                $newsByLang[$language->language] = News::with('category')->where('language', $language->language)->where('is_approved', 1)->orderByDesc('id')->get();
            } else {
                $newsByLang[$language->language] = News::with('category')->where('language', $language->language)->where('is_approved', 1)->where('author_id', auth()->guard('admin')->user()->id)->orderByDesc('id')->get();
            }
        }

        $title = 'Delete News!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.news.index', compact('languages', 'newsByLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.news.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsStoreRequest $request)
    {
        $title = $this->uniqueTitle($request->title, News::class);
        $slug = $this->uniqueSlug(Str::slug($title), News::class);
        $image = $this->fileUpload($request, 'image');

        $news =  new News();
        $news->title = $title;
        $news->slug = $slug;
        $news->content = $request->content;
        $news->image = $image;
        $news->language = $request->language;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking = $request->is_breaking == 1 ? 1 : 0;
        $news->is_slider = $request->is_slider  == 1 ? 1 : 0;
        $news->is_popular = $request->is_popular  == 1 ? 1 : 0;
        $news->status = $request->status  == 1 ? 1 : 0;
        $news->category_id = $request->category;
        $news->author_id = Auth::guard('admin')->user()->id;
        $news->is_approved = getRole() == 'Administrator' || checkPermission('Access News') ? 1 : 0;
        $news->save();

        $tags = array_filter(array_map('trim', explode(',', $request->tags)));
        $tagIds = [];

        foreach ($tags as $tag) {
            $tagItem = Tag::firstOrCreate([
                'name' => $tag,
                'language' => $news->language
            ]);
            $tagIds[] = $tagItem->id;
        }

        $news->tags()->attach($tagIds);

        toast(__('backend.News created successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.news.index');
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
        $news = News::findOrFail($id);

        if (!canAccess(['Access News'])) {
            if ($news->author_id != auth()->guard('admin')->user()->id) {
                return abort(404);
            }
        }

        $categories = Category::where('language', $news->language)->get();

        return view('admin.news.edit', compact('languages', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsUpdateRequest $request, string $id)
    {
        $news =  News::findOrFail($id);

        if (!canAccess(['Access News'])) {
            if ($news->author_id != auth()->guard('admin')->user()->id) {
                return abort(404);
            }
        }

        $image = $this->fileUpload($request, 'image', 'uploads/' . $news->image);

        // Update title
        if ($request->title !== $news->title) {
            $title = $this->uniqueTitle($request->title, News::class);
            $news->title = $title;
        } else {
            $title = $news->title; // fallback for slug
        }

        // Update slug
        if (is_null($request->slug) || trim($request->slug) === '') {
            // if empty slug then generate slug from title
            $slug = $this->uniqueSlug(Str::slug($title), News::class);
            $news->slug = $slug;
        } else {
            $news->slug = $request->slug;
        }

        $news->content = $request->content;
        $news->image = !empty($image) ? $image : $news->image;
        $news->language = $request->language;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking = $request->is_breaking == 1 ? 1 : 0;
        $news->is_slider = $request->is_slider  == 1 ? 1 : 0;
        $news->is_popular = $request->is_popular  == 1 ? 1 : 0;
        $news->status = $request->status  == 1 ? 1 : 0;

        if (getRole() == 'Administrator' || canAccess(['Access News'])) {
            $news->is_approved = $request->is_approved;
        }

        $news->category_id = $request->category;
        $news->save();

        $tags = array_filter(array_map('trim', explode(',', $request->tags)));
        $tagIds = [];

        foreach ($tags as $tag) {
            $tagItem = Tag::firstOrCreate([
                'name' => $tag,
                'language' => $news->language
            ]);
            $tagIds[] = $tagItem->id;
        }

        $news->tags()->sync($tagIds);

        toast(__('backend.News updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $news = News::findOrFail($id);

            if (!canAccess(['Access News'])) {
                if ($news->author_id != auth()->guard('admin')->user()->id) {
                    return abort(404);
                }
            }

            $this->fileDelete('uploads/' . $news->image);
            $news->delete();

            toast(__('backend.News deleted successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('backend.News deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.news.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function categories(Request $request)
    {
        $categories = Category::select('id', 'name')->where('language', $request->language)->get();

        return response()->json($categories);
    }

    /**
     * Duplicate of the resource.
     */
    public function duplicate(string $id)
    {
        $news = News::findOrFail($id);

        if (!canAccess(['Access News'])) {
            if ($news->author_id != auth()->guard('admin')->user()->id) {
                return abort(404);
            }
        }

        $title = $this->uniqueTitle($news->title, News::class);
        $slug = $this->uniqueSlug(Str::slug($title), News::class);

        $duplicate = $news->replicate();
        $duplicate->title = $title;
        $duplicate->slug = $slug;
        $duplicate->is_approved = getRole() == 'Administrator' || checkPermission('Access News') ? 1 : 0;;

        if ($news->image) {
            $newFileName = $this->fileCopy($news->image, 'uploads');
            if ($newFileName) {
                $duplicate->image = $newFileName;
            }
        }
    
        $duplicate->save();

        toast(__('backend.News duplicated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.news.edit', $duplicate->id);
    }

    /**
     * Pending of the resource.
     */
    public function pending()
    {
        if (canAccess(['Access News'])) {
            $news = News::with('category')->where('is_approved', 0)->orderByDesc('id')->get();
        } else {
            $news = News::with('category')->where('is_approved', 0)->where('author_id', auth()->guard('admin')->user()->id)->orderByDesc('id')->get();
        }

        $title = 'Delete Pending News!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.news.pending', compact('news'));
    }
}
