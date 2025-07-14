@extends('frontend.layouts.app')

@section('title', 'News')

@section('content')
    <section class="blog_pages">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ url('/') }}" class="breadcrumbs__url"> <i class="fa fa-home"></i> {{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:" class="breadcrumbs__url">{{ __('News') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog_page_search">
                        <form action="{{ route('news') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" value="{{ request()->search }}" name="search" placeholder="Type here" />
                                </div>
                                <div class="col-lg-4">
                                    <select name="category">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" {{ $category->slug == request()->category ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit">{{ __('search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <aside class="wrapper__list__article">
                        @if (request()->filled('category'))
                            <h4 class="border_section">{{ __('Category: ') . request()->category }}</h4>
                        @elseif (request()->has('tag'))
                            <h4 class="border_section">{{ __('Tag: ') . request()->tag }}</h4>
                        @else
                            <h4 class="border_section">{{ __('Search for: ') . request()->search }}</h4>
                        @endif

                        <div class="row">
                            @forelse ($news as $data)
                                <div class="col-lg-6">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{ route('news.details', $data->slug) }}">
                                                <img src="{{ asset('uploads/' . $data->image) }}" alt="" class="img-fluid" />
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <div class="article__category">{{ $data->category->name }}</div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary"> {{ __('by') }} {{ $data->author->name }} </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize"> {{ $data->created_at->format('F d, Y') }} </span>
                                                </li>
                                            </ul>
                                            <h5>
                                                <a href="{{ route('news.details', $data->slug) }}"> {!! truncate($data->title) !!} </a>
                                            </h5>
                                            <p>{!! truncate($data->content, 80) !!}</p>
                                            <a href="{{ route('news.details', $data->slug) }}" class="btn btn-outline-primary mb-4 text-capitalize"> {{ __('read more') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center w-100">
                                    <p>{{ __('No news found.') }}</p>
                                </div>
                            @endforelse
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $news->appends(request()->query())->links() }}
                        </div>
                    </aside>
                </div>
                <div class="col-md-4">
                    <div class="sidebar-sticky">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('Recent News') }}</h4>
                            <div class="wrapper__list__article-small">
                                @foreach ($recentNews as $news)
                                    @if ($loop->index <= 2)
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
                                                                <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($loop->index == 3)    
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
                                                        <span class="text-dark text-capitalize"> {{ $news->created_at->format('M d, Y') }} </span>
                                                    </li>
                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $news->slug) }}"> {!! truncate($news->title) !!} </a>
                                                </h5>
                                                <div>
                                                    {!! truncate($news->content, 180) !!}
                                                </div>
                                                <a href="{{ route('news.details', $news->slug) }}" class="btn btn-outline-primary mb-4 text-capitalize"> {{ __('Read More') }}</a>
                                            </div>
                                        </div>
                                    @endif
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

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>{{ __('The most important world news and events of the day') }}.</h6>
                                <p><small>{{ __('Get magzrenvi daily newsletter on your inbox') }}.</small></p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your email address" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">{{ __('sign up') }}</button>
                                    </div>
                                </div>
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
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        @if ($advertisement->archive_bottom_ad_status == 1)
            <div class="large_add_banner my-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="large_add_banner_img">
                                <a href="{{ $advertisement->archive_bottom_ad_url }}">
                                    <img src="{{ asset('uploads/' . $advertisement->archive_bottom_ad_image) }}" alt="adds" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
