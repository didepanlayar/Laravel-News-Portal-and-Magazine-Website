@extends('admin.layouts.guest')

@section('title') Reset Password @endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>{{ __('Reset Password') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.change-password') }}" class="needs-validation" novalidate="">
            @csrf

            <input id="token" type="hidden" class="form-control" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" tabindex="1" value="{{ @request()->email }}" disabled>
                <input id="email" type="hidden" class="form-control" name="email" tabindex="1" value="{{ @request()->email }}" required>
                @error('email')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    {{ __('Please fill in your email') }}
                </div>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="1" required autofocus>
                @error('password')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    {{ __('Please fill in your password') }}
                </div>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password Confirmation') }}</label>
                <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    {{ __('Please fill in your password confirmation') }}
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
