@extends('admin.layouts.guest')

@section('title') Reset Password @endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Reset Password</h4>
    </div>

    <div class="card-body">
        @if (session()->has('error'))
            <p style="color: red"><i><b>{{ session()->get('error') }}</b></i></p>
        @endif

        <form method="POST" action="{{ route('admin.change-password') }}" class="needs-validation" novalidate="">
            @csrf

            <input id="token" type="hidden" class="form-control" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ @request()->email }}" required>
                @error('email')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your email
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="1" required autofocus>
                @error('password')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your password
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Please fill in your password confirmation
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
