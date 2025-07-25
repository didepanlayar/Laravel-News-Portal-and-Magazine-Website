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
                                                                <a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
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
            });
        </script>
@endpush
