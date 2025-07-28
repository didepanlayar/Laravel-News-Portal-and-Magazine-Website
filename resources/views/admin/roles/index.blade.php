@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Roles') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Roles') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.Roles and Permissions') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('backend.Create') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="roles-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('backend.No') }}</th>
                                            <th>{{ __('backend.Roles') }}</th>
                                            <th>{{ __('backend.Permissions') }}</th>
                                            <th class="text-center">{{ __('backend.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @if ($role->name === 'Administrator')
                                                        <span class="badge badge-primary">{{ __('backend.All Permissions') }}</span>
                                                    @endif
                                                    @foreach ($role->permissions as $permission)
                                                        @if ($loop->index < 3)
                                                            <span class="badge badge-primary">{{ $permission->name }}</span>
                                                        @elseif ($loop->index == 3)
                                                            <span class="badge badge-secondary">
                                                                +{{ $role->permissions->count() - 3 }} more...
                                                            </span>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @if ($role->name != 'Administrator')
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.roles.destroy', $role->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                                                    @endif
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
            $("#roles-table").dataTable({
                "columnDefs": [
                    { "sortable": false, "targets": [1] }
                ]
            });
            
        });
    </script>
@endpush
