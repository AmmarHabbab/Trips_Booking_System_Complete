{{-- @extends('pages.master')

@section('content')


    <div class="w-full max-w-md mx-auto mt-10">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/book/payment/mtncash/{{$payment->id}}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </label>
            </div>
        @endif --}}
            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Choose Payment Currency
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cur" name="currency">
                    <option value="SY">SY</option> 
                    <option value="USD">USD</option>     
                </select>
            </div> --}}
                {{-- <div id="additional-inputs2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Send {{$payment->amount}} using mtn cash To this number : 0951905231 Then Enter the phone number you used to send the money
                        </label><br>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Phone number</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter your number" name="mtnnumb">
                    </div>
                </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>


@endsection --}}


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
                    <h1 class="text-white m-0"></h1>
                </div>
                <div class="card-body rounded-bottom bg-white p-5">
                    <form method="POST" action="/book/payment/mtncash/{{$payment->id}}">
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
                       
                        <label for=""><b>{{__('messages.Send')}}{{$payment->amount}}{{__('messages.using mtn cash To this number : ')}}0951905231 {{__('messages.Then Enter the phone number you used to send the money')}}</b></label><br>
                        <label class="" for="image"><b>{{__('messages.Phone number')}}</b></label>
                        <div class="form-group">
                            <input type="number" class="form-control p-4" placeholder="{{__('messages.Enter your number')}}" name="mtnnumb">
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary btn-block py-3" type="submit">{{__('messages.Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
