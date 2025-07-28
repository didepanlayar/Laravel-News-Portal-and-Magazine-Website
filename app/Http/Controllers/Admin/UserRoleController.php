<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRoleStoreRequest;
use App\Http\Requests\Admin\UserRoleUpdateRequest;
use App\Mail\Admin\UserRoleMail;
use App\Models\Admin;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    use FileUploadTrait;

    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Permission,admin'])->only('index');
        $this->middleware(['permission:Create Permission,admin'])->only('create', 'store');
        $this->middleware(['permission:Update Permission,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete Permission,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.users.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRoleStoreRequest $request)
    {
        try {
            $image = $this->fileUpload($request, 'image');

            $user = new Admin();
            $user->name = $request->name;
            $user->email =  $request->email;
            $user->picture = $image;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->save();

            // Assign role to the user
            $user->assignRole($request->role);

            // Send mail to the user
            Mail::to($request->email)->send(new UserRoleMail($request->name, $request->email, $request->password));

            toast(__('backend.User created successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.users.index');
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
        $user = Admin::findOrFail($id);
        $roles = Role::all();

        if($user->getRoleNames()->first() === 'Administrator') {
            toast(__('backend.Administrator cannot be edit'), 'error')->width('350')->timerProgressBar();

            return redirect()->route('admin.users.index');
        } else {
            return view('admin.users.edit', compact('user', 'roles'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRoleUpdateRequest $request, string $id)
    {
        if($request->has('password') && !empty($request->password)) {
            $request->validate([
                'password' => ['confirmed', 'min:6']
            ]);
        }

        $user = Admin::findOrFail($id);

        $image = $this->fileUpload($request, 'image', 'uploads/' . $user->picture);

        $user->name = $request->name;
        $user->email =  $request->email;
        $user->picture = !empty($image) ? $image : $user->picture;

        if($request->has('password') && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Assign role to the user
        $user->syncRoles($request->role);

        toast(__('backend.User updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = Admin::findOrFail($id);

            if($user->getRoleNames()->first() === 'Administrator') {
                toast(__('backend.Administrator cannot be deleted'), 'error')->width('350')->timerProgressBar();
            } else {
                $this->fileDelete('uploads/' . $user->picture);
                $user->delete();
    
                toast(__('backend.User deleted successfully'), 'success')->width('350')->timerProgressBar();
            }
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.users.index');
    }
}
