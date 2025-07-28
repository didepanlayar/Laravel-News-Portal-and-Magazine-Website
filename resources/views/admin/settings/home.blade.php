@extends('admin.layouts.app')

@section('title', 'Home Settings')

@push('styles')
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Home Settings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Home Settings') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.Home Sections') }}</h4>
                        </div>
                        <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    @foreach ($languages as $language)    
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="category-{{ $language->language }}" data-toggle="tab" href="#tab-{{ $language->language }}" role="tab" aria-controls="home" aria-selected="true">{{ $language->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    @foreach ($languages as $language)
                                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="tab-{{ $language->language }}" role="tabpanel" aria-labelledby="category-{{ $language->language }}">
                                            <form action="{{ route('admin.settings.home.update') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="language" value="{{ $language->language }}">
                                                <div class="form-group row">
                                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Category Section 1') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="category_section_1" id="">
                                                            <option value="">{{ __('backend.Select Category') }}</option>
                                                            @foreach ($categoriesByLang[$language->language] as $category)
                                                                <option value="{{ $category->id }}" {{ $homeSetting[$language->language]->category_section_1 == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Category Section 2') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="category_section_2" id="">
                                                            <option value="">{{ __('backend.Select Category') }}</option>
                                                            @foreach ($categoriesByLang[$language->language] as $category)
                                                                <option value="{{ $category->id }}" {{ $homeSetting[$language->language]->category_section_2 == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Category Section 3') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="category_section_3" id="">
                                                            <option value="">{{ __('backend.Select Category') }}</option>
                                                            @foreach ($categoriesByLang[$language->language] as $category)
                                                                <option value="{{ $category->id }}" {{ $homeSetting[$language->language]->category_section_3 == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="" class="col-sm-3 col-form-label">{{ __('backend.Category Section 4') }}</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="category_section_4" id="">
                                                            <option value="">{{ __('backend.Select Category') }}</option>
                                                            @foreach ($categoriesByLang[$language->language] as $category)
                                                                <option value="{{ $category->id }}" {{ $homeSetting[$language->language]->category_section_4 == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">{{ __('backend.Save') }}</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                toast($error, 'error')->width('350')->timerProgressBar();
            @endphp
        @endforeach
    @endif
@endpush
