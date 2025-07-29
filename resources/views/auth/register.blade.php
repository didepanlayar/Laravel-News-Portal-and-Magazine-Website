@extends('frontend.layouts.app')

@section('title', 'Register')

@section('content')
    <!-- register -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Register -->
                    <div class="card mx-auto" style="max-width: 520px">
                        <article class="card-body">
                            <header class="mb-4">
                                <h4 class="card-title">{{ __('frontend.Register') }}</h4>
                            </header>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('frontend.Name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('frontend.Name') }}" required />
                                    @error('name')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{ __('frontend.Email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('frontend.Email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">{{ __("frontend.We'll never share your email with anyone else") }}.</small>
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
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('frontend.Register') }}</button>
                                </div>
                            </form>
                        </article>
                    </div>
                    <!-- End Form Register -->
                </div>
            </div>
        </div>
    </section>
    <!-- end register -->
@endsection
