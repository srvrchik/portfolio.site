<!-- Start portfolio-area Area -->
<section class="portfolio-area section-gap" id="portfolio">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Our Latest Featured Projects</h1>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>
            </div>
        </div>

        <div class="filters">
            <ul>
                <li class="active" data-filter="*">All</li>
                @foreach($categories as $category)
                    <li data-filter=".{{ $category->title }}">{{ $category->title }}</li>
                @endforeach
            </ul>
        </div>

        <div class="filters-content">
            <div class="row grid">
                @foreach($projects as $project)
                    <div class="single-portfolio col-sm-4 all {{ $project->category->title }}">
                    <div class="relative">
                        <div class="thumb">
                            <div class="overlay overlay-bg"></div>
                            <img class="image img-fluid" src="/uploads/projects/{{ $project->image }}" alt="">
                        </div>
                        <a href="/uploads/projects/{{ $project->image }}" class="img-pop-up">
                            <div class="middle">
                                <div class="text align-self-center d-flex"><img src="/front/img/preview.png" alt=""></div>
                            </div>
                        </a>
                    </div>
                    <div class="p-inner">
                        <h4>{{ $project->title }}</h4>
                        <div class="cat">{{ $project->url }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
<!-- End portfolio-area Area -->
