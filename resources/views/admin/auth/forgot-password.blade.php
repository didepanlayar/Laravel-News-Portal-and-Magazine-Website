@extends('admin.layouts.guest')

@section('title') Forgot Password @endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Forgot Password</h4>
    </div>

    <div class="card-body">
        <p>Forgot password? No problem, we got you.</p>
        @if (session()->has('success'))
            <p style="color: green"><i><b>{{ session()->get('success') }}</b></i></p>
        @endif

        <form method="POST" action="{{ route('admin.forgot-password') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                @error('email')
                    <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your email
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Send Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
