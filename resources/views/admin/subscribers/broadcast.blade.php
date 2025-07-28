@extends('admin.layouts.app')

@section('title', 'Subscribers')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('backend.Subscribers') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('backend.Dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.subscribers') }}">{{ __('backend.Subscribers') }}</a></div>
                <div class="breadcrumb-item">{{ __('backend.Broadcast') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('backend.Send Broadcast') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.subscribers.broadcast.send') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('backend.Subject') }}</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" />
                                    @error('subject')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{ __('backend.Message') }}</label>
                                    <textarea class="summernote" name="message"></textarea>
                                    @error('message')
                                        <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('backend.Send') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
