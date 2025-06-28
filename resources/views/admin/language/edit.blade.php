@extends('admin.layouts.app')

@section('title', 'Create Languages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Languages') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.language.index') }}">{{ __('Languages') }}</a></div>
                <div class="breadcrumb-item">{{ __('Edit') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Edit Language') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.language.update', $language->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Language') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="language" id="select-language" required>
                                            <option value="">{{ __('Select Language') }}</option>
                                            @foreach (config('language') as $key => $lang)
                                                <option  value="{{ $key }}" {{ $language->language == $key ? 'selected' : '' }}>{{ $lang['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('language')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $language->name }}" placeholder="Name" readonly />
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Slug') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $language->slug }}" placeholder="Slug" readonly />
                                        @error('slug')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Default Language') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="default" id="">
                                            <option value="0" {{ $language->default == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                                            <option value="1" {{ $language->default == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                        </select>
                                        @error('default')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="">
                                            <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                            <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
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
    <script>
        $(document).ready(function() {
            $('#select-language').on('change', function() {
                let slug = $(this).val();
                let name = $(this).children(':selected').text();
                $('#slug').val(slug);
                $('#name').val(name);
            })
        })
    </script>
@endpush
