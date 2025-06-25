@extends('admin.layouts.guest')

@section('title') Login @endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>{{ __('Login') }}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.login') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                @error('email')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    {{ __('Please fill in your email') }}
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">{{ __('Password') }}</label>
                    <div class="float-right">
                        <a href="{{ route('admin.forgot-password') }}" class="text-small">{{ __('Forgot Password?') }}</a>
                    </div>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    {{ __('Please fill in your password') }}
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
