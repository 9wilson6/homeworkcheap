<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}} - @yield('title',"Hello")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset("plugins/sweetalert2/dist/sweetalert2.all.min.js")}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @yield("links")

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->

<!-- Top Bar -->
@include("inc.nav")
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    @yield("left-nav")
    <!-- #END# Left Sidebar -->
</section>
<!-- Left content section -->
<section class="content">
    <div class="content-breadcrumb shadow-sm">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @yield('breadcrumb-item')
            </ol>
        </nav>
    </div>
    <!-- #START# content container -->
    <div class="content-container">
        <div class="container-fluid" id="app">

                <main class="dashboard">
                    @include("inc.flashmessages")
                    @yield('content')
                </main>

        </div>
    </div>
    <!-- #END# content container -->
    <!-- #START# content footer -->
    <footer>
        <div class="d-flex justify-content-around pt-20">
            &copy; Gwilson 2020
        </div>
    </footer>
    <!-- #END# content footer -->
</section>
<!-- #END# content section-->
@yield("scripts")
{{--Lines of javascript that should run after Other javascript files have run--}}


</body>
</html>
