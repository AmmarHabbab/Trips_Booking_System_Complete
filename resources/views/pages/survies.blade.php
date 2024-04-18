

@extends('pages.master')

@section('content')

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">

                @foreach ($survies->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $survey)
                        <div class="col-md-4 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$survey->name}}</a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none" href="/survies/{{$survey->name}}">{{__('messages.Participate in Survey')}}</a>
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

@endsection