@extends('pages.master')



@section('content')



<!-- Blog Start -->
<div class="container pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="">{{$categoryy->translate()->name}}</h6>
        <h1>{{$categoryy->translate()->desc}}</h1>
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

