@extends('pages.master')

@section('content')
<style>
    .container-fluid {
    position: relative;
}

.col-md-6 {
    position: absolute;
    right: 0;
    margin-right: 340px;
}

.text {
    padding: 20px;
    background-color: #ffffff;
}
</style>
<center>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 justify-content-end">
                <div class="text bg-white p-4 p-lg-5 my-lg-5">
                    <h6 class="text-primary text-uppercase">{{$translater->name}}</h6>
                    <h1 class="mb-3">{{$translater->languages_spoken}}</h1>
                    <p>{{$translater->info}}
                    </p>
                    <h6>{{$translater->status}}</h6>
                    <h6>{{$translater->gender}}</h6>
                    <h6>{{__('messages.Hiring Price')}}:{{$translater->price}}</h6>
                </div>
            </div>
        </div>
    </div>
    </center>
@endsection