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
                            @foreach ($categorySection3 as $news)
                            <div class="col-md-6">
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
                            </div>
                            @endforeach
                        </div>
                    </aside>
                    <!-- End Category Section 3 -->

                    @if ($advertisement->home_bottom_ad_status == 1)
                        <div class="small_add_banner">
                            <div class="small_add_banner_img">
                                <a href="{{ $advertisement->home_bottom_ad_url }}">
                                    <img src="{{ asset('uploads/' . $advertisement->home_bottom_ad_image) }}" alt="adds" />
                                </a>
                            </div>
                        </div>
                    @endif

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
                            <h4 class="border_section">{{ __('Most Viewed') }}</h4>
                            <div class="wrapper__list__article-small">
                                @foreach ($mostViewed as $news)
                                    @if ($loop->index == 0)
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="{{ route('news.details', $news->slug) }}">
                                                    <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__category">{{ $news->category->name }}</div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary"> {{ __('by') }} {{ $news->author->name }} </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize"> {{ $news->created_at->format('F d, Y') }} </span>
                                                    </li>
                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                </h5>
                                                <p>{!! truncate($news->content, 140) !!}</p>
                                                <a href="{{ route('news.details', $news->slug) }}" class="btn btn-outline-primary mb-4 text-capitalize"> {{ __('read more') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($loop->index > 0)
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
                                                                    <span class="text-dark text-capitalize"> {{ $news->created_at->format('F d, Y') }} </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('stay conected') }}</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                @foreach ($socialMedia as $data)
                                    <a href="{{ $data->url }}" target="_blank">
                                        <div class="social__media__widget" style="background-color: {{ $data->color }}; margin-bottom: 10px;">
                                            <span class="social__media__widget-icon">
                                                <i class="{{ $data->icon }}"></i>
                                            </span>
                                            <span class="social__media__widget-counter"> {{ $data->count }} {{ $data->type }} </span>
                                            <span class="social__media__widget-name"> {{ $data->title }} </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('tags') }}</h4>
                            <div class="blog-tags p-0">
                                <ul class="list-inline">
                                    @foreach ($popularTags as $tag)    
                                        <li class="list-inline-item">
                                            <a href="{{ route('news', ['tag' => $tag->name]) }}"> #{{ $tag->name }} ({{ $tag->count }}) </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        @if ($advertisement->sidebar_ad_status == 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">{{ __('Advertise') }}</h4>
                                <a href="{{ $advertisement->sidebar_ad_url }}">
                                    <figure>
                                        <img src="{{ asset('uploads/' . $advertisement->sidebar_ad_image) }}" alt="" class="img-fluid" />
                                    </figure>
                                </a>
                            </aside>
                        @endif

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>{{ __('The most important world news and events of the day') }}.</h6>
                                <p><small>{{ __('Get magzrenvi daily newsletter on your inbox') }}.</small></p>
                                <form action="{{ route('subscribe.newsletter') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="Your email address" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">{{ __('sign up') }}</button>
                                        </div>
                                    </div>
                                    @error('email')
                                        @php
                                            toast($message, 'error')->width('350')->timerProgressBar();
                                        @endphp
                                    @enderror
                                </form>
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