<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialPlatformStoreRequest;
use App\Http\Requests\Admin\SocialPlatformUpdateRequest;
use App\Models\SocialPlatform;
use Illuminate\Http\Request;

class SocialPlatformController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Platform,admin'])->only('index');
        $this->middleware(['permission:Create Platform,admin'])->only('create', 'store');
        $this->middleware(['permission:Update Platform,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete Platform,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = SocialPlatform::all();

        $title = 'Delete Social Platform!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.social-platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialPlatformStoreRequest $request)
    {
        $platform = new SocialPlatform();
        $platform->name = $request->name;
        $platform->icon = $request->icon;
        $platform->url = $request->url;
        $platform->status = $request->status;
        $platform->save();

        toast(__('backend.Social Platform created successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.social-platform.index');
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
        $platform = SocialPlatform::findOrFail($id);

        return view('admin.social-platforms.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialPlatformUpdateRequest $request, string $id)
    {
        $platform = SocialPlatform::findOrFail($id);
        $platform->name = $request->name;
        $platform->icon = $request->icon;
        $platform->url = $request->url;
        $platform->status = $request->status;
        $platform->save();

        toast(__('backend.Social Platform edited successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.social-platform.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $platform = SocialPlatform::findOrFail($id);
            $platform->delete();

            toast(__('backend.Social Platform deleted successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('backend.Social Platform deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.social-platform.index');
    }
}
