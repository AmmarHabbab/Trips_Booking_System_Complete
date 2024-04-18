{{-- 

@extends('pages.master')

@section('content')

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">

                @foreach ($translaters->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $translater)
                        <div class="col-md-4 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height: 300px; object-fit: fill;" src="{{$translater->image}}" alt="">
                                </div>
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$translater->name}}</a>
                                        <span class="text-primary px-2">|</span>
                                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$translater->languages_spoken}}</a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none">{{$translater->info}}</a>
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
    @foreach ($translaters as $translater)
    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
        <div class="team-item bg-white mb-4">
            <div class="team-img position-relative overflow-hidden">
                <img class="img-fluid w-100" style="width: 250px;height:300px;" src="{{$translater->image}}" alt="">
            </div>
            <div class="text-center py-4">
                <h5 class="text-truncate">{{$translater->name}}</h5>
                <p class="m-0">{{$translater->info}}</p>
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
        <form action="/translaters/search" method="get">
        <div class="input-group">
            <input type="text" class="form-control p-4" placeholder="{{__('messages.Search For a Translater')}}" name="search">
            <div class="input-group-append">
               <button type="submit" class="input-group-text bg-primary border-primary text-white"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="container pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="">{{__('messages.Translaters')}}</h6>
        <h3>{{__('messages.All Translaters')}}</h3>
    </div>
    <div class="row">
       
        @foreach ($translaters as $translater)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
            <div class="team-item bg-white mb-4">
                <div class="team-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" style="width: 250px;height:300px;"  src="{{$translater->image}}" alt="">
                </div>
                <div class="text-center py-4">
                    <h5 class="text-truncate">{{$translater->name}}</h5>
                    <h6 class="text-truncate">{{$translater->languages_spoken}}</h6>
                    <h6>{{$translater->status}}</h6>
                    <p class="m-0"><a href="/translater/{{$translater->id}}">{{__('messages.Translater Bio')}}</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection