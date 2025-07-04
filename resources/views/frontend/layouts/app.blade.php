<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8" />
        <title>Top News - @yield('title', 'Welcome')</title>
        <meta name="description" content="" />
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
