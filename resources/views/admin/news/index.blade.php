@extends('admin.layouts.app')

@section('title', 'News')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('News') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('News') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('All News') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
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
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-{{ $language->language }}">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">{{ __('No') }}</th>
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Category') }}</th>
                                                            <th>{{ __('Author') }}</th>
                                                            <th class="text-center">{{ __('Created At') }}</th>
                                                            <th class="text-center">{{ __('Status') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>   
                                                        @foreach ($newsByLang[$language->language] as $news)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>
                                                                    {{ $news->title }}
                                                                    <div class="table-links">
                                                                        <a href="{{ route('news.details', $news->slug) }}" target="_blank">{{ __('View') }}</a>
                                                                        <div class="bullet"></div>
                                                                        <a href="{{ route('admin.news.edit', $news->id) }}">{{ __('Edit') }}</a>
                                                                        <div class="bullet"></div>
                                                                        <a href="{{ route('admin.news.duplicate', $news->id) }}">{{ __('Duplicate') }}</a>
                                                                        <div class="bullet"></div>
                                                                        <a href="{{ route('admin.news.destroy', $news->id) }}" class="text-danger" data-confirm-delete="true">{{ __('Delete') }}</a>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $news->category->name }}</td>
                                                                <td>{{ $news->author->name }}</td>
                                                                <td class="text-center">{{ $news->created_at->format('d-m-Y H:i') }}</td>
                                                                <td class="text-center">
                                                                    @if ($news->status == 1)
                                                                        <span class="badge badge-primary">{{ __('Published') }}</span>
                                                                    @else
                                                                        <span class="badge badge-danger">{{ __('Draft') }}</span>
                                                                    @endif
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
                            { orderable: false, targets: [2, 3] }
                        ]
                    });
                @endforeach
            });
        </script>
@endpush
