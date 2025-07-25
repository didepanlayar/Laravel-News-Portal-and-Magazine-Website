@extends('admin.layouts.app')

@section('title', 'Localizations')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Localizations') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Localizations') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Frontend App') }}</h4>
                            <div class="card-header-action">
                                <a href="" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('Create New') }}
                                </a>
                            </div>
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
                                        <div class="d-flex justify-content-end mb-3">
                                            <form action="{{ route('admin.localization.generate') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="directory" value="{{ resource_path('views/frontend') }}">
                                                <input type="hidden" name="language" value="{{ $language->language }}">
                                                <input type="hidden" name="file" value="frontend">
                                                <button type="submit" class="btn btn-primary">{{ __('Generate') }}</button>
                                            </form>
                                            <button type="submit" class="btn btn-dark ml-1">{{ __('Translate') }}</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-{{ $language->language }}">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">{{ __('No') }}</th>
                                                        <th>{{ __('Content') }}</th>
                                                        <th>{{ __('Translation') }}</th>
                                                        <th class="text-center">{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($translatedValues[$language->language] as $key => $value)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $value }}</td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#myModal" data-language="{{ $language->language }}" data-key="{{ $key }}" data-value="{{ $value }}"><i class="fas fa-edit"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ __('Edit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.localization.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="language">
                        <input type="hidden" name="file" value="frontend">
                        <div class="form-group">
                            <label>{{ __('Content') }}</label>
                            <input type="text" class="form-control" name="key" placeholder="Content" readonly />
                        </div>
                        <div class="form-group">
                            <label>{{ __('Translation') }}</label>
                            <input type="text" class="form-control" name="value" placeholder="Translation" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
        <script>
            $(document).ready(function() {
                @foreach ($languages as $language)
                    $('#table-{{ $language->language }}').dataTable({
                        autoWidth: false,
                        columnDefs: [
                            { orderable: false, targets: [1] }
                        ]
                    });
                @endforeach

                $('.btn-modal').on('click', function() {
                    let language = $(this).data('language');
                    let key = $(this).data('key');
                    let value = $(this).data('value');

                    $('input[name="language"]').val('');
                    $('input[name="key"]').val('');
                    $('input[name="value"]').val('');

                    $('input[name="language"]').val(language);
                    $('input[name="key"]').val(key);
                    $('input[name="value"]').val(value);
                });
            });
        </script>
@endpush
