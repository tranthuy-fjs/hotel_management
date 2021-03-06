<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.partials.head')
</head>
<body>
@include('frontend.partials.header_app')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @include('frontend.partials.sidebar_hotel')
            <div class="col-lg-9">
                <div class="row">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
</section>

@include('frontend.partials.footer')

@include('frontend.partials.main-js')
@yield('js')
</body>
</html>

