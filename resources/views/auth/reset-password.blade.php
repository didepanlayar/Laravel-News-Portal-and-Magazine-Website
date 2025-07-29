@extends('frontend.layouts.app')

@section('title', 'Register')

@section('content')
    <!-- Reset -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Reset -->
                    <div class="card mx-auto" style="max-width: 520px">
                        <article class="card-body">
                            <header class="mb-4">
                                <h4 class="card-title">{{ __('frontend.Reset Password') }}</h4>
                            </header>
                            <form action="{{ route('password.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group">
                                    <label>{{ __('frontend.Email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" placeholder="{{ __('frontend.Email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __('frontend.Password') }}</label>
                                        <input class="form-control" type="password" name="password" required />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{ __('frontend.Repeat Password') }}</label>
                                        <input class="form-control" type="password" name="password_confirmation" required />
                                    </div>

                                    <div class="form-group col-md-12">
                                        @error('password')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
    
                                        @error('password_confirmation')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('frontend.Reset Password') }}</button>
                                </div>
                            </form>
                        </article>
                    </div>
                    <!-- End Form Reset -->
                </div>
            </div>
        </div>
    </section>
    <!-- end Reset -->
@endsection

