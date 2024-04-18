{{-- @extends('pages.master')

@section('content')

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">

                @foreach ($posts->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $post)
                        <div class="col-md-4 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height: 300px; object-fit: fill;" src="{{$post->image}}" alt="">
                                </div>
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$post->user->name}}</a>
                                        <span class="text-primary px-2">|</span>
                                        <a class="text-primary text-uppercase text-decoration-none" href="">@if($post->category){{$post->category->translate()->name}}@else{{'not categorized'}}@endif</a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none" href="/posts/{{$post->slug}}">{{$post->translate()->title}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
              
            </div>
        </div>
    </div>
</div>

@endsection --}}

{{-- @extends('pages.master')

@section('content')


<div class="row">
    @foreach ($posts as $post)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="package-item bg-white mb-2">
            <img class="img-fluid" style="height: 300px; object-fit: fill;" src="{{$post->image}}" alt="">
            <div class="p-4">
                <div class="d-flex justify-content-between mb-3">
                    <small class="m-0">{{$post->user->name}}</small>
                    <small class="m-0"><a href="@if($post->category)/categories/{{$post->category->translate('en')->name}}@endif">@if($post->category){{$post->category->translate()->name}}@else{{'not categorized'}}@endif</a></small>
                </div>
                <a class="h5 text-decoration-none" href="/posts/{{$post->slug}}">{{$post->translate()->title}}</a>
               
            </div>
        </div>
    </div>
    
    @endforeach
</div>


@endsection --}}

@extends('pages.master')

@section('content')
<div class="mb-5" style="width: 300px;margin-left:121px;margin-top:20px;">
    <div class="bg-white" style="">
        <form action="/post/search" method="get">
        <div class="input-group">
            <input type="text" class="form-control p-4" placeholder="{{__('messages.Search For a Post')}}" name="search">
            <div class="input-group-append">
               <button type="submit" class="input-group-text bg-primary border-primary text-white"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="container pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="">{{__('messages.Posts')}}</h6>
        <h3>{{__('messages.All Posts')}}</h3>
    </div>
    <div class="row pb-3">
        @foreach ($posts as $post)
            
       
        <div class="col-lg-4 col-md-6 mb-4 pb-2">
            <div class="blog-item">
                <div class="position-relative">
                    <img class="img-fluid w-100" style="width: 370px;height:250px;object-fit: cover;" src="{{$post->image}}" alt="">
                    <div class="blog-date">
                        <h6 class="font-weight-bold mb-n1">{{$post->updated_at->format('d/M')}}</h6>
                        <small class="text-white text-uppercase">{{$post->updated_at->format('Y')}}</small>
                    </div>
                </div>
                <div class="bg-white p-4">
                    <div class="d-flex mb-2">
                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$post->user->name}}</a>
                        <span class="text-primary px-2">|</span>
                        <a class="text-primary text-uppercase text-decoration-none" href="/categories/{{$post->category->translate('en')->name}}">{{$post->category->translate()->name}}</a>
                    </div>
                   <center> <a class="h5 m-0 text-decoration-none" href="/posts/{{$post->slug}}">{{$post->translate()->title}}</a></center>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection