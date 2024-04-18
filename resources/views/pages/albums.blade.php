{{-- 

@extends('pages.master')

@section('content')

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">

                @foreach ($albums->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $album)
                        <div class="col-md-4 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height: 300px; object-fit: fill;" src="{{$album->image}}" alt="">
                                </div>
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">BY:{{$album->user->name}}</a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none" href="/album/{{$album->name}}">{{$album->name}}</a>
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


@extends('pages.master')

@section('content')

@if (session('message'))
<h4 align="center">{{ session('message') }}</h4>
@endif
<div class="mb-5" style="width: 300px;margin-left:121px;margin-top:20px;">
    <div class="bg-white" style="">
        <form action="/albums/search" method="get">
        <div class="input-group">
            <input type="text" class="form-control p-4" placeholder="{{__('messages.Search For a Album')}}" name="search">
            <div class="input-group-append">
               <button type="submit" class="input-group-text bg-primary border-primary text-white"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="container pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="">{{__('messages.Albums')}}</h6>
        <h3>{{__('messages.All Albums')}}</h3>
    </div>
    <div class="row">
        @foreach ($albums as $album)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="package-item bg-white mb-2">
                <img class="img-fluid" style="width: 370px;height:350px;object-fit: cover;" src="{{$album->image}}" alt="">
                <div class="p-4">
                   <center><a class="h5 text-decoration-none" href="/album/{{$album->name}}">{{$album->name}}</a></center>
                    <div class="border-top mt-4 pt-4">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0">{{$album->desc}}</6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection