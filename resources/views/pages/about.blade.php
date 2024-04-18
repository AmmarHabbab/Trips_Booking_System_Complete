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
                    <h6 class="text-primary text-uppercase">{{__('messages.About Us')}}</h6>
                    <h1 class="mb-3">{{__('messages.We Provide Best Local Syrian Trips To All Cities')}}</h1>
                    <p>{{__('messages.We Are a Local Trip')}}
                    </p>
                    <h6>0934558864 - ammarhabbab118@gmail.com</h6>
                    <h6>{{__('messages.Our Address')}}</h6>
                </div>
            </div>
        </div>
    </div>
    </center>
@endsection