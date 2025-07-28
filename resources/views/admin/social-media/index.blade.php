@extends('admin.layouts.app')

@section('title', 'Social Media')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Social Media') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Social Media') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.All Social Media') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.social-media.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('backend.Create New') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    @foreach ($languages as $language)    
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="data-{{ $language->language }}" data-toggle="tab" href="#tab-{{ $language->language }}" role="tab" aria-controls="home" aria-selected="true">{{ $language->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    @foreach ($languages as $language)
                                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="tab-{{ $language->language }}" role="tabpanel" aria-labelledby="data-{{ $language->language }}">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-{{ $language->language }}">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">{{ __('backend.No') }}</th>
                                                            <th>{{ __('backend.Name') }}</th>
                                                            <th>{{ __('backend.URL') }}</th>
                                                            <th>{{ __('backend.Language') }}</th>
                                                            <th class="text-center">{{ __('backend.Status') }}</th>
                                                            <th class="text-center">{{ __('backend.Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>   
                                                        @foreach ($dataByLang[$language->language] as $data)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $data->name }}</td>
                                                                <td>
                                                                    <a href="{{ $data->url }}" target="_blank">{{ $data->url }}</a>
                                                                </td>
                                                                <td>{{ $data->language }}</td>
                                                                <td class="text-center">
                                                                    @if ($data->status == 1)
                                                                        <span class="badge badge-primary">{{ __('backend.Active') }}</span>
                                                                    @else
                                                                        <span class="badge badge-danger">{{ __('backend.Inactive') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('admin.social-media.edit', $data->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                                    <a href="{{ route('admin.social-media.destroy', $data->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
