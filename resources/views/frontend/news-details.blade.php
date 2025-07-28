@extends('frontend.layouts.app')

@section('title', $news->title)
@section('meta_description', truncate($news->meta_description, 200))
@section('meta_og_title', $news->meta_title)
@section('meta_og_description', truncate($news->meta_description, 200))
@section('meta_og_image', asset('uploads/' . $news->image))
@section('meta_tw_title', $news->meta_title)
@section('meta_tw_description', truncate($news->meta_description, 200))
@section('meta_tw_image', asset('uploads/' . $news->image))

@push('styles')
    <style>
        .comments-area .comment-body .reply a.unstyle {
            all: unset;
            cursor: pointer;
            display: inline;
            color: inherit;
            text-decoration: none;
        }

        .comments-area .comment-body .reply a.unstyle::before {
            content: none !important;
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <section class="pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breaddcrumb -->
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ url('/') }}" class="breadcrumbs__url"> <i class="fa fa-home"></i> {{ __('frontend.Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__url">{{ __('frontend.News') }}</a>
                        </li>
                        <!-- <li class="breadcrumbs__item breadcrumbs__item--current">World</li> -->
                    </ul>
                    <!-- end breadcrumb -->
                </div>
                <div class="col-md-8">
                    <!-- content article detail -->
                    <!-- Article Detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title">
                            <h1>{!! $news->title !!}</h1>
                        </div>
                        <hr />
                        <div class="wrap__article-detail-info">
                            <ul class="list-inline d-flex flex-wrap justify-content-start">
                                <li class="list-inline-item">
                                    {{ __('frontend.By') }} <a href="javascript:;"> {{ $news->author->name }} </a>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1"> {{ $news->created_at->format('M d, Y') }} </span>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize"> {{ __('frontend.in') }} </span>
                                    <a href="#"> {{ $news->category->name }} </a>
                                </li>
                            </ul>
                        </div>

                        <div class="wrap__article-detail-image mt-4">
                            <figure>
                                <img src="{{ asset('uploads/' . $news->image) }}" alt="" class="img-fluid" />
                            </figure>
                        </div>
                        <div class="wrap__article-detail-content">
                            <div class="total-views">
                                <div class="total-views-read">
                                    {{ convertViewed($news->views) }}
                                    <span> {{ __('frontend.views') }} </span>
                                </div>

                                <ul class="list-inline">
                                    <span class="share">{{ __('frontend.share on:') }}</span>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>{{ __('frontend.facebook') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o twitter" href="https://twitter.com/intent/tweet?text={{ $news->title }}&url={{ url()->current() }}" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                            <span>{{ __('frontend.twitter') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o whatsapp" href="https://wa.me/?text={{ $news->title }}%20{{ url()->current() }}" target="_blank">
                                            <i class="fa fa-whatsapp"></i>
                                            <span>{{ __('frontend.whatsapp') }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o telegram" href="https://t.me/share/url?url={{ url()->current() }}&text={{ $news->title }}" target="_blank">
                                            <i class="fa fa-telegram"></i>
                                            <span>{{ __('frontend.telegram') }}</span>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a class="btn btn-linkedin-o linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $news->title }}" target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                            <span>{{ __('frontend.linkedin') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                {!! $news->content !!}
                            </div>
                        </div>
                    </div>
                    <!-- end content article detail -->

                    <!-- tags -->
                    <!-- News Tags -->
                    <div class="blog-tags">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="fa fa-tags"> </i>
                            </li>
                            @foreach ($news->tags as $tag)    
                                <li class="list-inline-item">
                                    <a href="{{ route('news', ['tag' => $tag->name]) }}"> #{{ $tag->name }} </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end tags-->

                    <!-- authors-->
                    <!-- Profile author -->
                    <div class="wrap__profile">
                        <div class="wrap__profile-author">
                            <figure>
                                <img src="{{ asset('uploads/' . $news->author->picture) }}" alt="" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" />
                            </figure>
                            <div class="wrap__profile-author-detail">
                                <div class="wrap__profile-author-detail-name">{{ __('frontend.author') }}</div>
                                <h4>{{ $news->author->name }}</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis laboriosam ad beatae itaque ea non placeat officia ipsum praesentium! Ullam?</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o instagram">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o telegram">
                                            <i class="fa fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="btn btn-social btn-social-o linkedin">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end author-->

                    <!-- Comment  -->
                    <div id="comments" class="comments-area">
                        <h3 class="comments-title">{{ $news->comments()->count() }} {{ __('frontend.Comments:') }}</h3>

                        @foreach ($news->comments()->whereNull('parent_id')->get() as $comment)    
                            <ol class="comment-list">
                                <li class="comment">
                                    <aside class="comment-body">
                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img src="{{ asset('frontend/assets/images/avatar.png') }}" class="avatar" alt="image" />
                                                <b class="fn">{{ $comment->user->name }}</b>
                                                <span class="says">{{ __('frontend.says:') }}</span>
                                            </div>

                                            <div class="comment-metadata">
                                                <a href="#">
                                                    <span>{{ $comment->created_at->format('F d, Y \a\t H:i') }}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{ $comment->comment }}</p>
                                        </div>

                                        <div class="reply">
                                            <a href="#" class="comment-reply-link" data-toggle="modal" data-target="#commentModal-{{ $comment->id }}">{{ __('frontend.Reply') }}</a>
                                            @if (auth()->id() === $comment->user_id)      
                                                <span>
                                                    <a href="{{ route('news.comment.destroy', $comment->id) }}" class="unstyle" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                                                </span>
                                            @endif
                                        </div>
                                    </aside>

                                    @if ($comment->reply()->count() > 0)
                                        @foreach ($comment->reply as $reply)    
                                            <ol class="children">
                                                <li class="comment">
                                                    <aside class="comment-body">
                                                        <div class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <img src="{{ asset('frontend/assets/images/avatar.png') }}" class="avatar" alt="image" />
                                                                <b class="fn">{{ $reply->user->name }}</b>
                                                                <span class="says">{{ __('frontend.says:') }}</span>
                                                            </div>

                                                            <div class="comment-metadata">
                                                                <a href="#">
                                                                    <span>{{ $reply->created_at->format('F d, Y \a\t H:i') }}</span>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="comment-content">
                                                            <p>{{ $reply->comment }}</p>
                                                        </div>

                                                        <div class="reply">
                                                            @if ($loop->last)
                                                                <a href="#" class="comment-reply-link" data-toggle="modal" data-target="#commentModal-{{ $comment->id }}">{{ __('frontend.Reply') }}</a>
                                                            @else
                                                                <p></p>
                                                            @endif

                                                            @if (auth()->id() === $reply->user_id)   
                                                                <span>
                                                                    <a href="{{ route('news.comment.destroy', $reply->id) }}" class="unstyle" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </aside>
                                                </li>
                                            </ol>
                                        @endforeach
                                    @endif
                                </li>
                            </ol>

                            <!-- Modal -->
                            <div class="comment_modal">
                                <div class="modal fade" id="commentModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ __('frontend.Write Your Comment') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @auth    
                                                    <form action="{{ route('news.comment.reply') }}" method="POST">
                                                        @csrf
                                                        <textarea name="reply" cols="30" rows="7" placeholder="Type. . ."></textarea>
                                                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <button type="submit">submit</button>
                                                    </form>
                                                @else
                                                    <p class="comment-notes">{{ __('frontend.Please') }} <a href="{{ route('login') }}">{{ __('frontend.login') }}</a> {{ __('frontend.to reply comment') }}.</p>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="comment-respond">
                            <h3 class="comment-reply-title">{{ __('frontend.Leave a Reply') }}</h3>
                            @auth    
                                <form action="{{ route('news.comment') }}" method="POST" class="comment-form">
                                    @csrf
                                    <p class="comment-notes">
                                        <span id="email-notes">{{ __('frontend.Your email address will not be published') }}.</span>
                                        {{ __('frontend.Required fields are marked') }}
                                        <span class="required">*</span>
                                    </p>
                                    <p class="comment-form-comment">
                                        <label for="comment">{{ __('frontend.Comment') }}</label>
                                        <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525" required="required"></textarea>
                                        @error('comment')
                                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <p class="form-submit mb-0">
                                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                                        <input type="hidden" name="parent_id" value="">
                                        <input type="submit" name="submit" id="submit" class="submit" value="Post Comment" />
                                    </p>
                                </form>
                            @else
                                <p class="comment-notes">{{ __('frontend.Please') }} <a href="{{ route('login') }}">{{ __('frontend.login') }}</a> {{ __('frontend.to post comment') }}.</p>
                            @endauth
                        </div>
                    </div>
                    <!-- end comment -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="single_navigation-prev">
                                @if ($previousPost)    
                                    <a href="{{ route('news.details', $previousPost->slug) }}">
                                        <span>{{ __('frontend.previous post') }}</span>
                                        {!! truncate($previousPost->title, 100) !!}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single_navigation-next text-left text-md-right">
                                @if ($nextPost)    
                                    <a href="{{ route('news.details', $nextPost->slug) }}">
                                        <span>{{ __('frontend.next post') }}</span>
                                        {!! truncate($nextPost->title, 100) !!}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($advertisement->news_bottom_ad_status == 1)
                        <div class="small_add_banner mb-5 pb-4">
                            <div class="small_add_banner_img">
                                <a href="{{ $advertisement->news_bottom_ad_url }}">
                                    <img src="{{ asset('uploads/' . $advertisement->news_bottom_ad_image) }}" alt="adds" />
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>

                    <div class="related-article">
                        @if (count($relatedPosts) > 0)    
                            <h4>{{ __('frontend.you may also like') }}</h4>

                            <div class="article__entry-carousel-three">
                                @foreach ($relatedPosts as $post)    
                                    <div class="item">
                                        <!-- Post Article -->
                                        <div class="article__entry">
                                            <div class="article__image">
                                                <a href="#">
                                                    <img src="{{ asset('uploads/' . $post->image) }}" alt="{{ route('news.details', $post->slug) }}" class="img-fluid" />
                                                </a>
                                            </div>
                                            <div class="article__content">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary"> {{ __('frontend.by') }} {{ $post->author->name }} </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span> {{ $post->created_at->format('F d, Y') }} </span>
                                                    </li>
                                                </ul>
                                                <h5>
                                                    <a href="{{ route('news.details', $post->slug) }}"> {!! truncate($post->title) !!} </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <!-- <h4 class="border_section">Sidebar</h4> -->
                            <div class="mb-4">
                                <div class="widget__form-search-bar">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0" value="" placeholder="{{ __('frontend.Search') }}" />
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                                    <span class="text-primary"> {{ __('frontend.by') }} {{ $news->author->name }} </span>
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
                                                        <span class="text-primary"> {{ __('frontend.by') }} {{ $news->author->name }} </span>
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
                                                <a href="{{ route('news.details', $news->slug) }}" class="btn btn-outline-primary mb-4 text-capitalize"> {{ __('frontend.Read More') }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </aside>

                        <!-- social media -->
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('frontend.stay conected') }}</h4>
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
                        <!-- End social media -->

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{ __('frontend.tags') }}</h4>
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
                            <h4 class="border_section">{{ __('frontend.newsletter') }}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>{{ __('frontend.The most important world news and events of the day') }}.</h6>
                                <p><small>{{ __('frontend.Get magzrenvi daily newsletter on your inbox') }}.</small></p>
                                <form action="{{ route('subscribe.newsletter') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="{{ __('frontend.Your email address') }}" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">{{ __('frontend.sign up') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </aside>

                        @if ($advertisement->sidebar_ad_status == 1)
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">{{ __('frontend.Advertise') }}</h4>
                                <a href="{{ $advertisement->sidebar_ad_url }}">
                                    <figure>
                                        <img src="{{ asset('uploads/' . $advertisement->sidebar_ad_image) }}" alt="" class="img-fluid" />
                                    </figure>
                                </a>
                            </aside>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @error('email')
        <script>
            Swal.fire({
                title: @json(strip_tags($message)),
                toast: true,
                icon: 'error',
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 5000,
                timerProgressBar: true,
                background: '#fff',
                width: '350',
                padding: '1.25rem'
            });
        </script>
    @enderror
@endpush
