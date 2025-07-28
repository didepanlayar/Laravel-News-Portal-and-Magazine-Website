@extends('admin.layouts.app')

@section('title', 'Pending News')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Pending News') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Pending News') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.All Pending News') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-news">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('backend.No') }}</th>
                                            <th>{{ __('backend.Title') }}</th>
                                            <th>{{ __('backend.Category') }}</th>
                                            <th>{{ __('backend.Author') }}</th>
                                            <th>{{ __('backend.Language') }}</th>
                                            <th class="text-center">{{ __('backend.Created At') }}</th>
                                            <th class="text-center">{{ __('backend.Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach ($news as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $data->title }}
                                                    <div class="table-links">
                                                        <a href="{{ route('admin.news.edit', $data->id) }}">{{ __('backend.Edit') }}</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.news.duplicate', $data->id) }}">{{ __('backend.Duplicate') }}</a>
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('admin.news.destroy', $data->id) }}" class="text-danger" data-confirm-delete="true">{{ __('backend.Delete') }}</a>
                                                    </div>
                                                </td>
                                                <td>{{ $data->category->name }}</td>
                                                <td>{{ $data->author->name }}</td>
                                                <td>{{ $data->language }}</td>
                                                <td class="text-center">{{ $data->created_at->format('d-m-Y H:i') }}</td>
                                                <td class="text-center">
                                                    <span class="badge badge-warning">{{ __('backend.Pending') }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                $('#table-news').dataTable({
                    autoWidth: false,
                    columnDefs: [
                        { orderable: false, targets: [2, 3] }
                    ]
                });
            });
        </script>
@endpush
