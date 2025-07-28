@extends('admin.layouts.app')

@section('title', 'Edit Social Media')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Social Media') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.social-media.index') }}">{{ __('backend.Social Media') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Edit') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.Edit Social Media') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.social-media.update', $socialMedia->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Language') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="language" id="select-language" required>
                                            <option value="">{{ __('backend.Select Language') }}</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->language }}" {{ $language->language == $socialMedia->language ? 'selected' : '' }}>{{ $language['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('language')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $socialMedia->name }}" placeholder="Name" required />
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Icon') }}</label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" role="iconpicker" name="icon" data-icon="{{ $socialMedia->icon }}"></button>
                                        @error('icon')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.URL') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="url" name="url" value="{{ $socialMedia->url }}" placeholder="https://example.com" required />
                                        @error('url')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Count') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="count" name="count" value="{{ $socialMedia->count }}" placeholder="Count" required />
                                        @error('count')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Type') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="type" name="type" value="{{ $socialMedia->type }}" placeholder="Type" required />
                                        @error('type')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Title') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $socialMedia->title }}" placeholder="Title" required />
                                        @error('title')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Color') }}</label>
                                    <div class="col-sm-9">
                                        <div class="input-group colorpickerinput">
                                            <input type="text" class="form-control" name="color" value="{{ $socialMedia->color }}"/>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <i class="fas fa-fill-drip"></i>
                                                </div>
                                            </div>
                                            @error('color')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Status') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="">
                                            <option value="0" {{ $socialMedia->status == 0 ? 'selected' : '' }}>{{ __('backend.Inactive') }}</option>
                                            <option value="1" {{ $socialMedia->status == 1 ? 'selected' : '' }}>{{ __('backend.Active') }}</option>
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
    <script src="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',
        });
    </script>
@endpush
