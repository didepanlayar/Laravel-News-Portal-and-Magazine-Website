@extends('admin.layouts.app')

@section('title', 'Subscribers')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Subscribers') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Subscribers') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.All Subscribers') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.subscribers.broadcast') }}" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> {{ __('backend.Broadcast') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="subscriber-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('backend.No') }}</th>
                                            <th>{{ __('backend.Email') }}</th>
                                            <th class="text-center">{{ __('backend.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers as $subscriber)    
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.subscribers.destroy', $subscriber->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
            $("#subscriber-table").dataTable({
                "columnDefs": [
                    { "sortable": false, "targets": [1] }
                ]
            });
            
        });
    </script>
@endpush
