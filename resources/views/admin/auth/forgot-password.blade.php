@extends('admin.layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>{{ __('backend.Forgot Password') }}</h4>
    </div>

    <div class="card-body">
        <p>{{ __('backend.Forgot password? No problem, we got you.') }}</p>
        <form method="POST" action="{{ route('admin.forgot-password') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('backend.Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                @error('email')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    {{ __('backend.Please fill in your email') }}
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('backend.Send Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
