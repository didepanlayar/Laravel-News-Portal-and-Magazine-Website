<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Mail\Admin\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthenticationController extends Controller
{
    /**
     * Login view.
     */
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle login authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Forgot password view.
     */
    public function forgot()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Send reset link.
     */
    public function send(ForgotPasswordRequest $request)
    {
        $token = Str::random(64);

        $admin =  Admin::where('email', $request->email)->first();
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));

        Alert::success(__('Success'), __('A email has been sent to your email address'));

        return redirect()->back();
    }

    /**
     * Reset password view
     */
    public function reset($token)
    {
        return view('admin.auth.reset-password', compact('token'));
    }

    /**
     * Change password
     */
    public function change(ResetPasswordRequest $request)
    {
        $admin = Admin::where(['email' => $request->email, 'remember_token' => $request->token])->first();

        if(!$admin)
        {
            Alert::error(__('Error'), __('Token is invalid'));

            return redirect()->route('admin.login');
        }

        $admin->password = bcrypt($request->password);
        $admin->remember_token = null;
        $admin->save();

        Alert::success(__('Success'), __('Password reset successfully'));

        return redirect()->route('admin.login');
    }
}
