@extends('admin.layouts.app')

@section('title') Profile @endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Profile') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ __('Hi') }}, {{ $user->name }}!</h2>
            <p class="section-lead">{{ __('Change information about yourself on this page') }}.</p>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Edit Profile') }}</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('profile-success'))
                                <p style="color: green"><i><b>{{ session()->get('profile-success') }}</b></i></p>
                            @endif
                            <form method="POST" action="{{ route('admin.profile.update', auth()->guard('admin')->user()->id) }}" class="needs-validation" novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Picture') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                            <input type="file" name="image" id="image-upload" />
                                            <input type="hidden" name="old_image" value="{{ $user->picture }}" />
                                        </div>
                                        <div>
                                            @error('image')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required />
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">{{ __('Please fill in the name') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required />
                                        @error('email')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">{{ __('Please fill in the email') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Update Password') }}</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('password-success'))
                                <p style="color: green"><i><b>{{ session()->get('password-success') }}</b></i></p>
                            @endif
                            <form method="POST" action="{{ route('admin.update-password', auth()->guard('admin')->user()->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Current Password') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="current_password" required />
                                        @error('current_password')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">{{ __('Please fill in the old password') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('New Password') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="password" required />
                                        @error('password')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">{{ __('Please fill in the new password') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Confirmed Password') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="password_confirmation" required />
                                        <div class="invalid-feedback">{{ __('Please fill in the confirm password') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    @if($user->picture)
        <script>
            $(document).ready(function() {
                $('.image-preview').css({
                    'background-image': 'url({{ asset("uploads/" . $user->picture) }})',
                    'background-size': 'cover',
                    'background-position': 'center',
                });
            });
        </script>
    @endif
@endpush
