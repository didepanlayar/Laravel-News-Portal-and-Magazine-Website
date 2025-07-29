@extends('frontend.layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto my-5" style="max-width: 380px">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('frontend.Forgot Password') }}</h4>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="{{ __('frontend.Email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('frontend.Email Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end login -->
@endsection

@push('scripts')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    @if (session()->has('status'))
        <script>
            Swal.fire({
                title: @json(strip_tags(session('status'))),
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
