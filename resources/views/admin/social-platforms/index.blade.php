@extends('admin.layouts.app')

@section('title', 'Social Platforms')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Social Platforms') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Social Platforms') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('All Social Platforms') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.social-platform.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('Create') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="platform-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('No') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Icon') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($platforms as $platform)    
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ $platform->url }}" target="_blank">{{ $platform->name }}</a>
                                                </td>
                                                <td>
                                                    <i class="{{ $platform->icon }}" style="font-size: 25px"></i>
                                                </td>
                                                <td class="text-center">
                                                    @if ($platform->status == 1)
                                                        <span class="badge badge-primary">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.social-platform.edit', $platform->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.social-platform.destroy', $platform->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
            $("#platform-table").dataTable({
                "columnDefs": [
                    { "sortable": false, "targets": [1] }
                ]
            });
            
        });
    </script>
@endpush
