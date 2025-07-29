@extends('frontend.layouts.app')

@section('title', 'Login')

@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 380px">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('frontend.Login') }}</h4>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" placeholder="{{ __('frontend.Email') }}" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="{{ __('frontend.Password') }}" />
                                </div>

                                <div class="form-group">
                                    <a href="{{ route('password.request') }}" class="float-right">{{ __('frontend.Forgot password?') }}</a>
                                    <label class="float-left custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" />
                                        <span class="custom-control-label"> {{ __('frontend.Remember') }} </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('frontend.Login') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <p class="text-center mt-4 mb-0">{{ __("frontend.Don't have account?") }} <a href="{{ route('register') }}">{{ __('frontend.Register') }}</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- end login -->
@endsection

@push('scripts')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    @if($errors->has('email') || $errors->has('password'))
        <script>
            Swal.fire({
                title: @json(strip_tags($errors->first('email') ?: $errors->first('password'))),
                toast: true,
                icon: 'error',
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 5000,
                timerProgressBar: true,
                background: '#fff',
                width: '350',
                padding: '1.25rem'
            });
        </script>
    @endif
@endpush
