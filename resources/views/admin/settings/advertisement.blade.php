@extends('admin.layouts.app')

@section('title', 'Advertisements')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Advertisements') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Advertisements') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Update') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.advertisements.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Home') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="archive-tab" data-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">{{ __('Archive') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="false">{{ __('News') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="side-tab" data-toggle="tab" href="#side" role="tab" aria-controls="side" aria-selected="false">{{ __('Sidebar') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8">
                                        <div class="tab-content no-padding" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="form-group">
                                                    <label class="form-control-label">{{ __('Top Ad') }}</label>
                                                    <input type="text" class="form-control mb-2" name="home_top_ad_url" value="{{ $advertisement->home_top_ad_url }}" placeholder="https://example.com" />
                                                    @if ($advertisement->home_top_ad_image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('uploads/' . $advertisement->home_top_ad_image) }}" width="100%">
                                                        </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" name="home_top_ad_image" class="custom-file-input" />
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="form-text text-muted">{{ __('The image must have a maximum size of 5MB') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="home_top_ad_status" class="custom-switch-input" {{ $advertisement->home_top_ad_status == 1 ? 'checked' : '' }} value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-control-label">{{ __('Bottom Ad') }}</label>
                                                    <input type="text" class="form-control mb-2" name="home_bottom_ad_url" value="{{ $advertisement->home_bottom_ad_url }}" placeholder="https://example.com" />
                                                    @if ($advertisement->home_bottom_ad_image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('uploads/' . $advertisement->home_bottom_ad_image) }}" width="100%">
                                                        </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" name="home_bottom_ad_image" class="custom-file-input" />
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="form-text text-muted">{{ __('The image must have a maximum size of 5MB') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="home_bottom_ad_status" class="custom-switch-input" {{ $advertisement->home_bottom_ad_status == 1 ? 'checked' : '' }} value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                                                <div class="form-group">
                                                    <label class="form-control-label">{{ __('Bottom Ad') }}</label>
                                                    <input type="text" class="form-control mb-2" name="archive_bottom_ad_url" value="{{ $advertisement->archive_bottom_ad_url }}" placeholder="https://example.com" />
                                                    @if ($advertisement->archive_bottom_ad_image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('uploads/' . $advertisement->archive_bottom_ad_image) }}" width="100%">
                                                        </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" name="archive_bottom_ad_image" class="custom-file-input" />
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="form-text text-muted">{{ __('The image must have a maximum size of 5MB') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="archive_bottom_ad_status" class="custom-switch-input" {{ $advertisement->archive_bottom_ad_status == 1 ? 'checked' : '' }} value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
                                                <div class="form-group">
                                                    <label class="form-control-label">{{ __('Bottom Ad') }}</label>
                                                    <input type="text" class="form-control mb-2" name="news_bottom_ad_url" value="{{ $advertisement->news_bottom_ad_url }}" placeholder="https://example.com" />
                                                    @if ($advertisement->news_bottom_ad_image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('uploads/' . $advertisement->news_bottom_ad_image) }}" width="100%">
                                                        </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" name="news_bottom_ad_image" class="custom-file-input" />
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="form-text text-muted">{{ __('The image must have a maximum size of 5MB') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="news_bottom_ad_status" class="custom-switch-input" {{ $advertisement->news_bottom_ad_status == 1 ? 'checked' : '' }} value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="side" role="tabpanel" aria-labelledby="side-tab">
                                                <div class="form-group">
                                                    <label class="form-control-label">{{ __('Sidebar Ad') }}</label>
                                                    <input type="text" class="form-control mb-2" name="sidebar_ad_url" value="{{ $advertisement->sidebar_ad_url }}" placeholder="https://example.com" />
                                                    @if ($advertisement->sidebar_ad_image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('uploads/' . $advertisement->sidebar_ad_image) }}" width="50%">
                                                        </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" name="sidebar_ad_image" class="custom-file-input" />
                                                        <label class="custom-file-label">{{ __('Choose File') }}</label>
                                                    </div>
                                                    <div class="form-text text-muted">{{ __('The image must have a maximum size of 5MB') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="sidebar_ad_status" class="custom-switch-input" {{ $advertisement->sidebar_ad_status == 1 ? 'checked' : '' }} value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-md-right">
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @php
                toast($error, 'error')->width('350')->timerProgressBar();
            @endphp
        @endforeach
    @endif
@endpush
