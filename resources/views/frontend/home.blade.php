@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Breaking news  carousel-->
    @include('frontend.components.home.breaking-news')
    <!-- End Breaking news carousel -->

    <!-- Hero news -->
    @include('frontend.components.home.hero')
    <!-- End Hero news -->

    @if ($advertisement->home_top_ad_status == 1)
        <div class="large_add_banner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="large_add_banner_img">
                            <a href="{{ $advertisement->home_top_ad_url }}">
                                <img src="{{ asset('uploads/' . $advertisement->home_top_ad_image) }}" alt="adds" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Popular news category -->
    @include('frontend.components.home.main-news')
    <!-- End Popular news category -->
@endsection