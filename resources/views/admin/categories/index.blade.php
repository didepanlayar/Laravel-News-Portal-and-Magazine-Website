@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Categories') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Categories') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('All Categories') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
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
                                                            <th>{{ __('Languge') }}</th>
                                                            <th class="text-center">{{ __('Display') }}</th>
                                                            <th class="text-center">{{ __('Status') }}</th>
                                                            <th class="text-center">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>   
                                                        @foreach ($categoriesByLang[$language->language] as $category)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $category->name }}</td>
                                                                <td>{{ $category->language }}</td>
                                                                <td class="text-center">
                                                                    @if ($category->display == 1)
                                                                        <span class="badge badge-info">{{ __('Yes') }}</span>
                                                                    @else
                                                                        <span class="badge badge-light">{{ __('No') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($category->status == 1)
                                                                        <span class="badge badge-primary">{{ __('Active') }}</span>
                                                                    @else
                                                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                                    <a href="{{ route('admin.categories.destroy', $category->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
            @foreach ($languages as $language)
                $("#table-{{ $language->language }}").dataTable({
                    "columnDefs": [
                        { "sortable": false, "targets": [2,3] }
                    ]
                });
            @endforeach
        </script>
@endpush
