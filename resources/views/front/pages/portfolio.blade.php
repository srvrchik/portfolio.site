@extends('front.layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="about-banner">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Portfolio
                    </h1>
                    <p class="text-white link-nav"><a href="/">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="portfolio.html"> Portfolio</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    @include('front.layouts.partials.portfolio')

@endsection
