@extends('front.layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="about-banner">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        About Me
                    </h1>
                    <p class="text-white link-nav"><a href="/">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="about.html"> About Me</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start home-about Area -->
    <section class="home-about-area section-gap">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 home-about-left">
                    <img class="img-fluid" src="/front/img/about-img.png" alt="">
                </div>
                <div class="col-lg-5 col-md-6 home-about-right">
                    <h6>About Me</h6>
                    <h1 class="text-uppercase">Personal Details</h1>
                    <p>
                        Here, I focus on a range of items and features that we use in life without giving them a second thought. such as Coca Cola. Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                    </p>
                </div>
                <div class="col-lg-12 pt-60">
                    <p>
                        It won’t be a bigger problem to find one video game lover in your neighbor. Since the introduction of Virtual Game, it has been achieving great heights so far as its popularity and technological advancement are concerned. The history of video game is as interesting as a fairy tale.
                    </p>
                    <p>
                        The quality of today’s video game was not at all there when video game first conceptualized and played ever. During the formulative years, video games were created by using various interactive electronic devices with various display formats. The first ever video game was designed in 1947 by Thomas T. Goldsmith Jr.
                    </p>
                    <h4 class="pt-30">Tools Expertness</h4>
                </div>
            </div>
            <div class="row skillbar-wraps">
                <?php $i = 0; ?>
                @foreach($skills as $skill)
                    @if($i % 3 == 0 && $i < 3)
                        <div class="col-lg-6 skill-left">
                    @endif
                    @if($i % 3 == 0 && $i >= 3)
                        <div class="col-lg-6 skill-right">
                    @endif
                        <div class="single-skill">
                            <p>
                                {{ $skill->title }} {{ $skill->percent }}%
                            </p>
                            <div class="skill" data-width="{{ $skill->percent }}"></div>
                        </div>
                            @if($i == 2 || $i == 5)
                    </div>
                            @endif
                    <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End home-about Area -->

@endsection
