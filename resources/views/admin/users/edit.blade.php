@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Edit User') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Users') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
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
                                    </div>
                                    <div class="col-md-6">
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
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly />
                                                @error('email')
                                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                @enderror
                                                <div class="invalid-feedback">{{ __('Please fill in the email') }}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Password') }}</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="password" class="form-control" name="password" placeholder="********" />
                                                @error('password')
                                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                                @enderror
                                                <div class="invalid-feedback">{{ __('Please fill in the new password') }}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Confirmed Password') }}</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="********" />
                                                <div class="invalid-feedback">{{ __('Please fill in the confirm password') }}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Role') }}</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control select2" name="role">
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $role->name === $user->getRoleNames()->first() ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                            </div>
                                        </div>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Image Upload
            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Choose File",   // Default: Choose File
                label_selected: "Change File",  // Default: Change File
                no_label: false,                // Default: false
                success_callback: null          // Default: null
            });

            @if($user->picture)
                // User have picture
                $('.image-preview').css({
                    'background-image': 'url({{ asset("uploads/" . $user->picture) }})',
                    'background-size': 'cover',
                    'background-position': 'center',
                });
            @endif
        });
    </script>
@endpush
