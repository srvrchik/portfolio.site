<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Personal</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="/front/css/linearicons.css">
    <link rel="stylesheet" href="/front/css/font-awesome.min.css">
    <link rel="stylesheet" href="/front/css/bootstrap.css">
    <link rel="stylesheet" href="/front/css/magnific-popup.css">
    <link rel="stylesheet" href="/front/css/jquery-ui.css">
    <link rel="stylesheet" href="/front/css/nice-select.css">
    <link rel="stylesheet" href="/front/css/animate.min.css">
    <link rel="stylesheet" href="/front/css/owl.carousel.css">
    <link rel="stylesheet" href="/front/css/main.css">
</head>
<body>
@include('front.layouts.partials.header')

@if(request()->path() == '/')
    @include('front.layouts.partials.banner')

    @include('front.layouts.partials.home-about')
@endif

@yield('content')

@include('front.layouts.partials.footer')

<script src="/front/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/front/js/popper.min.js"></script>
<script src="/front/js/vendor/bootstrap.min.js"></script>
<script src="/front/js/easing.min.js"></script>
<script src="/front/js/hoverIntent.js"></script>
<script src="/front/js/superfish.min.js"></script>
<script src="/front/js/jquery.ajaxchimp.min.js"></script>
<script src="/front/js/jquery.magnific-popup.min.js"></script>
<script src="/front/js/jquery.tabs.min.js"></script>
<script src="/front/js/jquery.nice-select.min.js"></script>
<script src="/front/js/isotope.pkgd.min.js"></script>
<script src="/front/js/waypoints.min.js"></script>
<script src="/front/js/jquery.counterup.min.js"></script>
<script src="/front/js/simple-skillbar.js"></script>
<script src="/front/js/owl.carousel.min.js"></script>
<script src="/front/js/mail-script.js"></script>
<script src="/front/js/main.js"></script>
</body>
</html>
