@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Breaking news  carousel-->
    @include('frontend.components.home.breaking-news')
    <!-- End Breaking news carousel -->

    <!-- Hero news -->
    @include('frontend.components.home.hero')
    <!-- End Hero news -->

    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <img src="{{ asset('frontend/assets/images/ads.png') }}" alt="adds" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    @include('frontend.components.home.main-news')
    <!-- End Popular news category -->
@endsection