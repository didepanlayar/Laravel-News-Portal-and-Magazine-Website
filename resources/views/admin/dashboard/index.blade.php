@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('backend.Dashboard') }}</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('backend.Total Admin') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $admin }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('backend.Total News') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $news }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-info"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('backend.Pending News') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $pending }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('backend.Inbox') }}</h4>
                    </div>
                    <div class="card-body">
                        1,201
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection