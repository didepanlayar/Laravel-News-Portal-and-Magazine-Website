@extends('admin.layouts.app')

@section('title', 'Edit Social Platforms')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Social Platforms') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.social-platform.index') }}">{{ __('backend.Social Platforms') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Edit') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.Edit Social Platforms') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.social-platform.update', $platform->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $platform->name }}" placeholder="Name" required />
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Icon') }}</label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" role="iconpicker" data-icon="{{ $platform->icon }}" name="icon"></button>
                                        @error('icon')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.URL') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="url" name="url" value="{{ $platform->url }}" placeholder="https://example.com" required />
                                        @error('url')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Status') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="">
                                            <option value="0" {{ $platform->status == 0 ? 'selected' : '' }}>{{ __('backend.Inactive') }}</option>
                                            <option value="1" {{ $platform->status == 1 ? 'selected' : '' }}>{{ __('backend.Active') }}</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('backend.Update') }}</button>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/modules/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush
