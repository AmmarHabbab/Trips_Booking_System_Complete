
@extends('pages.master')

@section('content')
    <style>
        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            /* height: 100vh; */
        }
    </style>
    <div class="signup-container">
        <div class="col-lg-5">
            <div class="card border-0">
                <div class="card-header bg-primary text-center p-4">
                    <h1 class="text-white m-0">{{ $trip->translate()->name }}</h1>
                </div>
                <div class="card-body rounded-bottom bg-white p-5">
                    <form method="POST" action="/book/{{ $trip->id }}/payment">
                        @csrf
                        @if ($errors->any())
                            <div class="mb-4">
                                <label class=" for="image">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </label>
                            </div>
                        @endif
                        <label for=""><b>{{ __('messages.Trip Price') }}:{{ $trip->price }}</b></label><br>
                        <label
                            for=""><b>{{ __('messages.Avaialable seats') }}:{{ $available_seats }}</b></label><br><br>
                            <label for=""><b>{{__('messages.Choose payment method')}}</b></label>
                            <div class="form-group">
                                <select class="form-control" id="type" name="payment">
                                    <option value="1">{{ __('messages.Cash') }}</option>
                                    <option value="2">{{ __('messages.Syriatel Cash') }}</option>
                                    <option value="3">{{ __('messages.MTN Cash') }}</option>
                                </select>
                            </div>
                            <label for=""><b><a href="/translater">{{ __('messages.Check Our Translaters Here') }}</a></b></label><br>
                            <label for=""><b>{{ __('messages.Choose a translater if u want') }}</b></label>
                        <div class="form-group">
                            <select class="form-control" id="" name="translater">
                                <option value="0">{{ __('messages.Choose a translater if u want') }}</option>
                                @foreach ($translaters as $translater)
                                    <option value="{{ $translater->id }}">{{ $translater->name }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <label for=""><b>{{__('messages.Enter a Coupon If You Want')}}</b></label>
                        <div class="form-group">
                            <input type="text" class="form-control p-4" placeholder="{{__('messages.Enter Coupon Code')}}" name="coupon">
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary btn-block py-3" type="submit">{{__('messages.Book Now')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
