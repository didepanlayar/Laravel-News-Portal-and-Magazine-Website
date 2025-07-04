<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Welcome') - Top News</title>
        <meta name="description" content="@yield('meta_description')" />
        <meta name="og:title" content="@yield('meta_og_title')" />
        <meta name="og:description" content="@yield('meta_og_description')" />
        <meta name="og:image" content="@yield('meta_og_image')" />
        <meta name="twitter:title" content="@yield('meta_tw_title')" />
        <meta name="twitter:description" content="@yield('meta_tw_description')" />
        <meta name="twitter:image" content="@yield('meta_tw_image')" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet" />
        @stack('styles')
    </head>

    <body>
        <!-- Header news -->
        @include('frontend.layouts.header')
        <!-- End Header news -->

        @yield('content')

        <!-- Footer section -->
        @include('frontend.layouts.footer')
        <!-- End Footer section -->

        <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Libarary -->
        @include('sweetalert::alert')

        <!-- Page Specific JS File -->
        @stack('scripts')

        <script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>

        <script>
            // Select language
            $(document).ready( function() {
                $('#site-language').on('change', function() {
                    let language = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: "{{ route('language') }}",
                        data: {code: language},
                        success: function(data) {
                            if(data.status == 'success') {
                                window.location.reload()
                            }
                        },
                        error: function(data) {
                            console.error(data); 
                        }
                    })
                })
            })
        </script>
    </body>
</html>
