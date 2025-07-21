@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Create Role') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}">{{ __('Roles') }}</a></div>
                <div class="breadcrumb-item">{{ __('Create') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Roles and Permissions') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.roles.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="role" name="role" placeholder="Role" required />
                                        @error('role')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @foreach ($permissions as $groupName => $permission)
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">{{ $groupName }}</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                @foreach ($permission as $item)
                                                    <div class="col-sm-3">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" class="custom-switch-input" name="permissions[]" value="{{ $item->name }}" />
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">{{ $item->name }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
