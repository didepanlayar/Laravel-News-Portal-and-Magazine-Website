<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">{{ __('recent post') }}</h4>
                    </div>
                    <div class="row">
                        @foreach ($recentNews as $news)
                            @if ($loop->index <= 1)    
                                <div class="col-sm-12 col-md-6 mb-4">
                                    <!-- Post Article -->
                                    <div class="card__post">
                                        <div class="card__post__body card__post__transition">
                                            <a href="{{ route('news.details', $news->slug) }}">
                                                <img src="{{ asset('uploads/' . $news->image) }}" class="img-fluid" alt="" />
                                            </a>
                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">{{ $news->category->name }}</div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!}</a>
                                                    </h5>
                                                </div>
                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="#"> {{ __('by') }} {{ $news->author->name }} </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span> {{ $news->created_at->format('M d, Y') }} </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index > 1 && $loop->index <= 3)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.details', $news->slug) }}">
                                                        <img src="{{ asset('uploads/' . $news->image) }}" class="img-fluid" alt="" />
                                                    </a>
                                                </div>

                                                <div class="card__post__body">
                                                    <div class="card__post__content">
                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize"> {{ $news->created_at->format('M d, Y') }} </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title, 40) !!} </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index > 3 && $loop->index <= 5)
                                        <div class="mb-3">
                                            <!-- Post Article -->
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ route('news.details', $news->slug) }}">
                                                        <img src="{{ asset('uploads/' . $news->image) }}" class="img-fluid" alt="" />
                                                    </a>
                                                </div>

                                                <div class="card__post__body">
                                                    <div class="card__post__content">
                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-dark text-capitalize"> {{ $news->created_at->format('M d, Y') }} </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title, 40) !!} </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{ __('popular post') }}</h4>
                        <div class="wrapper__list-number">
                            @foreach ($popularNews as $news)
                                <!-- List Article -->
                                <div class="card__post__list">
                                    <div class="list-number">
                                        <span> {{ $loop->iteration }} </span>
                                    </div>
                                    <a href="#" class="category"> {{ $news->category->name }} </a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h5>
                                                <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                            </h5>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Section 1 -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySection1->first()->category->name }}</h4>
                </aside>
            </div>

            <div class="col-md-12">
                <div class="article__entry-carousel">
                    @foreach ($categorySection1 as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.details', $news->slug) }}">
                                        <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span> {{ $news->created_at->format('F d, Y') }} </span>
                                        </li>
                                    </ul>
                                    <h5>
                                        <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title, 35) !!} </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Category Section 1 -->

    <!-- Category Section 2 -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{ @$categorySection2->first()->category->name }}</h4>
                </aside>
            </div>

            <div class="col-md-12">
                <div class="article__entry-carousel">
                    @foreach ($categorySection2 as $news)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{ route('news.details', $news->slug) }}">
                                        <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span> {{ $news->created_at->format('F d, Y') }} </span>
                                        </li>
                                    </ul>
                                    <h5>
                                        <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title, 30) !!} </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Category Section 2 -->

    <!-- Another news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- Category Section 3 -->
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">{{ @$categorySection3->first()->category->name }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($categorySection3 as $news)
                                    @if ($loop->index <= 2)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news.details', $news->slug) }}">
                                                        <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span> {{ $news->created_at->format('F d, Y') }} </span>
                                                        </li>
                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="col-md-6">
                                @foreach ($categorySection3 as $news)
                                    @if ($loop->index > 2 && $loop->index <= 5)
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="{{ route('news.details', $news->slug) }}">
                                                        <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span> {{ $news->created_at->format('F d, Y') }} </span>
                                                        </li>
                                                    </ul>
                                                    <h5>
                                                        <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </aside>
                    <!-- End Category Section 3 -->

                    <div class="small_add_banner">
                        <div class="small_add_banner_img">
                            <img src="{{ asset('frontend/assets/images/ads.png') }}" alt="adds" />
                        </div>
                    </div>

                    <!-- Category Section 4 -->
                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">{{ @$categorySection4->first()->category->name }}</h4>

                        <div class="wrapp__list__article-responsive">
                            @foreach ($categorySection4 as $news)
                                <!-- Post Article List -->
                                <div class="card__post card__post-list card__post__transition mt-30">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card__post__transition">
                                                <a href="{{ route('news.details', $news->slug) }}">
                                                    <img src="{{ asset('uploads/' . $news->image) }}" class="img-fluid w-100" alt="" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 my-auto pl-0">
                                            <div class="card__post__body">
                                                <div class="card__post__content">
                                                    <div class="card__post__category">{{ $news->category->name }}</div>
                                                    <div class="card__post__author-info mb-2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize"> {{ $news->created_at->format('F d, Y') }} </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h5>
                                                            <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                        </h5>
                                                        <p class="d-none d-lg-block d-xl-block mb-0">{!! truncate($news->content, 140) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                    <!-- End Category Section 4 -->
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Latest post</h4>
                            <div class="wrapper__list__article-small">
                                <!-- Post Article -->
                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/news.png') }}" alt="" class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <div class="article__category">travel</div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary"> by david hall </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize"> descember 09, 2016 </span>
                                            </li>
                                        </ul>
                                        <h5>
                                            <a href="#"> Proin eu nisl et arcu iaculis placerat sollicitudin ut est </a>
                                        </h5>
                                        <p>Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu iaculis placerat sollicitudin ut est. In fringilla dui dui.</p>
                                        <a href="#" class="btn btn-outline-primary mb-4 text-capitalize"> read more</a>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/thumbnail.png') }}" class="img-fluid" alt="" />
                                            </a>
                                        </div>
                                        <div class="card__post__body">
                                            <div class="card__post__content">
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary"> by david hall </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize"> descember 09, 2016 </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="#"> 6 Best Tips for Building a Good Shipping Boat </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/thumbnail.png') }}" class="img-fluid" alt="" />
                                            </a>
                                        </div>
                                        <div class="card__post__body">
                                            <div class="card__post__content">
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary"> by david hall </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize"> descember 09, 2016 </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="#"> 6 Best Tips for Building a Good Shipping Boat </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">stay conected</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                <a href="#" target="_blank">
                                    <div class="social__media__widget facebook">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <span class="social__media__widget-counter"> 19,243 fans </span>
                                        <span class="social__media__widget-name"> like </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget twitter">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                        <span class="social__media__widget-counter"> 2.076 followers </span>
                                        <span class="social__media__widget-name"> follow </span>
                                    </div>
                                </a>
                                <a href="#" target="_blank">
                                    <div class="social__media__widget youtube">
                                        <span class="social__media__widget-icon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <span class="social__media__widget-counter"> 15,200 followers </span>
                                        <span class="social__media__widget-name"> subscribe </span>
                                    </div>
                                </a>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">tags</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#"> #property </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #sea </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #programming </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #sea </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #property </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #life style </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #technology </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #framework </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #sport </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #game </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #wfh </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #sport </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #game </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #wfh </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#"> #framework </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Advertise</h4>
                            <a href="#">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/news.png') }}" alt="" class="img-fluid" />
                                </figure>
                            </a>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">newsletter</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>The most important world news and events of the day.</h6>
                                <p><small>Get magzrenvi daily newsletter on your inbox.</small></p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your email address" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">sign up</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="mx-auto">
                    <!-- Pagination -->
                    <div class="pagination-area">
                        <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn">
                            <a href="#"> « </a>
                            <a href="#"> 1 </a>
                            <a class="active" href="#"> 2 </a>
                            <a href="#"> 3 </a>
                            <a href="#"> 4 </a>
                            <a href="#"> 5 </a>
                            <a href="#"> » </a>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>