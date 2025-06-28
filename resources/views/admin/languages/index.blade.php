@extends('admin.layouts.app')

@section('title', 'Languages')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Languages') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Languages') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('All Languages') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.languages.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="language-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Languge') }}</th>
                                            <th class="text-center">{{ __('Default') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($languages as $language)    
                                            <tr>
                                                <td>{{ $language->name }}</td>
                                                <td>{{ $language->language }}</td>
                                                <td class="text-center">
                                                    @if ($language->default == 1)
                                                        <span class="badge badge-info">{{ __('Default') }}</span>
                                                    @else
                                                        <span class="badge badge-light">{{ __('No') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($language->status == 1)
                                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.languages.edit', $language->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.languages.destroy', $language->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
        $("#language-table").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2,3] }
            ]
        });
    </script>
@endpush
