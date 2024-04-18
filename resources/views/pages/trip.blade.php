@extends('pages.master')

@section('content')
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
            color: #222;
            background-color: #ccc;
        }
    </style>
    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="pb-3">
                        <div class="blog-item">
                            {{-- <a href="{{$post->image}}">
                                <img src="{{$post->image}}" height="300" width="300">
                            </a> --}}
                        </div>
                        <div class="bg-white mb-3" style="padding: 30px;">
                            {{-- <div class="d-flex mb-3">
                                <a class="text-primary text-uppercase text-decoration-none" href="">{{$post->user->name}}</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="/categories/{{$post->category->translate('en')->name}}">{{$post->category->translate()->name}}</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">{{$post->updated_at->format('d/M/Y')}}</a>
                            </div> --}}
                            <h2 class="mb-3">{{ $trip->translate()->name }}</h2>

                            <h6 class="mb-3">{{ $trip->translate()->area }}</h6>
                                <hr>
                                <p>{!! $trip->translate()->info !!}</p>
                                <hr>
                                <h6 class="mb-3">{{ $trip->start_date->format('d/M/Y') }} {{__('messages.Start Date')}} </h6>
                                    <h6 class="mb-3"> {{ $trip->expiry_date->format('d/M/Y') }} {{__('messages.End Date')}}</h6>
                                        <h6 class="mb-3">{{__('messages.Seats')}}:{{ $trip->seats }}</h6>
                                            <h6 class="mb-3">{{__('messages.Seats Taken')}}:{{ $trip->seats_taken }}</h6>
                                        
                                            @if(app()->getLocale() == 'en')
                                            
                                                @if ($trip->status == 'حجز_مفتوح') 
                                            
                                                <h6 class="mb-3">{{__('messages.Trip Status')}}:Booking Opened</h6>
                                                @endif
                                            @if ($trip->status == 'حجز_مغلق') 
                                                <h6 class="mb-3">{{__('messages.Trip Status')}}:Booking Closed</h6>
                                                @endif
                                            @if ($trip->status == 'ملغية') 
                                                <h6 class="mb-3">{{__('messages.Trip Status')}}:Trip Canceled</h6>
                                                @endif
                                            @if ($trip->status == 'الأن') 
                                                <h6 class="mb-3">{{__('messages.Trip Status')}}:Trip is Ongoing</h6>
                                                @endif
                                            @if ($trip->status == 'منتهية') 
                                                <h6 class="mb-3">{{__('messages.Trip Status')}}:Trip is Over</h6>
                                                @endif
                                        
                                        @else 
                                            <h6 class="mb-3">{{__('messages.Trip Status')}}:{{ $trip->status }}</h6>
                                        
                                        @endif
                                                
                                            
                                                
                                                    <h3 class="mb-3" align="right">{{ $trip->price }}SY</h3>
                                                        @if (Auth::check())
                                                            <a href="/book/{{ $trip->id }}" "><h3 style="color:green;">{{__('messages.Book Now')}}</h3></a>
                                                        @else
                                                            <h4> {{ 'Login to Book' }}</h4>
                                                        @endif
                        </div>
                    </div>
                    <!-- Blog Detail End -->
                    @if (Auth::check())
                        <!-- like form start -->
                        <div class="like-dislike-container">
                            <div class="tool-box">
                                <button class="btn-close">×</button>
                            </div>
                            <p class="text-content">What did you think<br>of this post?</p>
                            <div class="icons-box">
                                <div class="icons">
                                    <form action="/liketrip/{{ $trip->id }}" method="post">
                                        @csrf
                                        <label class="btn-label" for="like-checkbox">
                                            <span class="like-text-content">{{ $like_count }}</span>
                                            <input class="input-box" id="like-checkbox" type="submit">
                                            <svg class="svgs" id="icon-like-solid" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z">
                                                </path>
                                            </svg>
                                            <svg class="svgs" id="icon-like-regular" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z">
                                                </path>
                                            </svg>
                                            <div class="fireworks">
                                                <div class="checked-like-fx"></div>
                                            </div>
                                        </label>
                                    </form>
                                </div>
                                <div class="icons">
                                    <form action="/disliketrip/{{ $trip->id }}" method="post">
                                        @csrf
                                        <label class="btn-label" for="dislike-checkbox">
                                            <input class="input-box" id="dislike-checkbox" type="submit">
                                            <div class="fireworks">
                                                <div class="checked-dislike-fx"></div>
                                            </div>

                                            <svg class="svgs" id="icon-dislike-solid" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z">
                                                </path>
                                            </svg>
                                            <svg class="svgs" id="icon-dislike-regular" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z">
                                                </path>
                                            </svg>
                                            <span class="dislike-text-content">{{ $dislike_count }}</span>
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br>

                        <!-- like form end -->
                        <!-- share -->
                        <div class="">
                            <h2 align="center">{{__('messages.Share')}}</h2>
                            <br>
                            {{-- {!! $shareComponent !!} --}}
                            <div id="social-links">
                                <ul>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/trips/{{ $trip->id }}"
                                            class="social-button " id="" title="" rel=""><span
                                                class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="https://twitter.com/intent/tweet?text={{ $trip->translate()->name }}&amp;url=http://127.0.0.1:8000/trips/{{ $trip->id }}"
                                            class="social-button " id="" title="" rel=""><span
                                                class="fab fa-twitter"></span></a></li>
                                    <li><a target="_blank"
                                            href="https://telegram.me/share/url?url=http://127.0.0.1:8000/trips/{{ $trip->id }}&amp;text={{ $trip->translate()->name }}"
                                            class="social-button " id="" title="" rel=""><span
                                                class="fab fa-telegram"></span></a></li>
                                    <li><a target="_blank"
                                            href="https://wa.me/?text=http://127.0.0.1:8000/trips/{{ $trip->id }}"
                                            class="social-button " id="" title="" rel=""><span
                                                class="fab fa-whatsapp"></span></a></li>
                                </ul>
                            </div>
                            <br>
                        </div>
                        <!-- share end -->
                        <!-- Comment Form Start -->
                        <div class="bg-white mb-3" style="padding: 30px;">
                            <h4 class="text-uppercase mb-4" style="">{{__('messages.Leave a comment')}}</h4>
                            <form method="POST" action="/tripcomments/{{ $trip->id }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{__('messages.Body:')}}</label>
                                    <textarea class="form-control" name="body" placeholder="{{__('messages.Enter your comment!')}}"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="{{__('messages.Leave a comment')}}"
                                        class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                </div>
                            </form>
                        </div>
                        <!-- Comment Form End -->

                        <!-- Comment List Start -->
                        <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                            <h4 class="text-uppercase mb-4" style="">{{__('messages.Comments')}}</h4>
                            @foreach ($comments as $comment)
                                <div class="media mb-4">
                                    <div class="media-body">
                                        <h6><a>{{ $comment->users->name }}</a>
                                            <small><i>{{ $comment->created_at->format('d/M/Y') }}</i></small>
                                        </h6>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <!-- Comment List End -->
                    @else
                        {{ 'Login to Like Comment and Share' }}
                    @endif
                </div>


            @endsection
