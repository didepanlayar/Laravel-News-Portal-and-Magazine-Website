<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\Admin;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();

        return view('admin.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, string $id)
    {
        $image = $this->fileUpload($request, 'image', 'uploads/' . $request->old_image);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email =  $request->email;
        $admin->picture = !empty($image) ? $image : $request->old_image;
        $admin->save();

        toast(__('Profile update successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->back();
    }

    /**
     * Update the password.
     */
    public function change(PasswordUpdateRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        toast(__('Password update successfully'), 'success')->timerProgressBar();

        return redirect()->back();
    }
}
