@extends('admin.layouts.app')

@section('title', 'Create News')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.News') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.news.index') }}">{{ __('backend.News') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Create') }}</div>
            </div>
        </div>
        <div class="section-body">
            <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>{{ __('backend.Create News') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('backend.Title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" />
                                    @error('title')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">{{ parse_url(config('app.url'), PHP_URL_HOST) }}</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup" name="slug">
                                    </div>
                                    @error('slug')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @else
                                        <div><span style="font-size: 80%;">If you keep this blank, this slug will automatically use the title of this post.</span></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('backend.Content') }}</label>
                                    <textarea class="summernote" name="content"></textarea>
                                    @error('content')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('backend.Tags') }}</label>
                                    <input type="text" class="form-control inputtags" name="tags">
                                    @error('tags')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ __('backend.Configuration') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>{{ __('backend.Language') }}</label>
                                            <select class="form-control select2" name="language" id="language" required>
                                                <option value="">{{ __('backend.Select Language') }}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->language }}">{{ $language->name }}</option>
                                                    @endforeach
                                            </select>
                                            @error('language')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('backend.Category') }}</label>
                                            <select class="form-control select2" name="category" id="category">
                                                <option value="">{{ __('backend.Select Category') }}</option>
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="control-label">{{ __('backend.Status') }}</div>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status" class="custom-switch-input" value="1" />
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                            @if (canAccess(['News Status', 'Access News']))
                                                <div class="col-md-6">
                                                    <div class="control-label">{{ __('backend.Breaking News') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="is_breaking" class="custom-switch-input" value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="control-label">{{ __('backend.Add to Slider') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="is_slider" class="custom-switch-input" value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="control-label">{{ __('backend.Add to Popular') }}</div>
                                                    <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="is_popular" class="custom-switch-input" value="1" />
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('backend.Create') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ __('backend.Feature Image') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div id="image-preview" class="image-preview" style="width: unset;">
                                                <label for="image-upload" id="image-label">{{ __('backend.Choose File') }}</label>
                                                <input type="file" name="image" id="image-upload" />
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ __('backend.Search Engine Optimization') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>{{ __('backend.Meta Title') }}</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title" />
                                            @error('meta_title')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('backend.Meta Description') }}</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description" />
                                            @error('meta_description')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Summernote
            $(".summernote").summernote({
                minHeight: 650,
            });

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

            // Input Tags
            $(".inputtags").tagsinput('items');

             // Get category by language
            $('#language').on('change', function() {
                let language = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.news.categories') }}",
                    data: {
                        language: language
                    },
                    success: function(data) {
                        $('#category').html("");
                        $('#category').html(`<option value="">{{ __('backend.Select Category') }}</option>`);

                        $.each(data, function(index, data) {
                            $('#category').append(`<option value="${data.id}">${data.name}</option>`)
                        })
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
