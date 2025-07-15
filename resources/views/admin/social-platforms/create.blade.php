@extends('admin.layouts.app')

@section('title', 'Create Social Platforms')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Social Platforms') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.social-platform.index') }}">{{ __('Social Platforms') }}</a></div>
                <div class="breadcrumb-item">{{ __('Create') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Create Social Platforms') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.social-platform.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Icon') }}</label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" role="iconpicker" name="icon"></button>
                                        @error('icon')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('URL') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com" required />
                                        @error('url')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="">
                                            <option value="0">{{ __('Inactive') }}</option>
                                            <option value="1">{{ __('Active') }}</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
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
