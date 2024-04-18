{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Post Entry Form</title>
</head>
<body class="bg-gray-100">
    <div class="w-full max-w-md mx-auto mt-10">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('rates.store')}}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </label>
            </div>
        @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Your Rating
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="Enter your rating" name="body"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Stars
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="stars">
                    <option>1</option> 
                    <option>2</option> 
                    <option>3</option> 
                    <option>4</option> 
                    <option>5</option> 
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Trip name
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="trip">
                    <option value="General Rating">General Rating</option> 
                    @foreach($trips as $trip)
                    <option value="{{$trip->id}}">{{$trip->name}}</option> 
                    @endforeach
                </select>
            </div>
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>
</html> --}}

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
                    <form method="POST" action="/rates/store">
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
                        <label class="" for="image"><b>{{ __('messages.Your Rating') }}</b></label>
                        <div class="form-group">
                            <textarea class="form-control p-4" name="body" required placeholder="{{__('messages.Enter Suggestion')}}"></textarea>
                        </div>
                        <label class="" for="image"><b>{{ __('messages.Suggestion Type') }}</b></label>
                        <div class="form-group">
                            <select class="form-control" id="category" name="stars">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <label class="" for="image"><b>{{ __('messages.Rating Type') }}</b></label>
                        <div class="form-group">
                            <select class="form-control" id="category" name="trip">
                        <option value="0">{{__('messages.General Rating')}}</option> 
                    @foreach($trips as $trip)
                    <option value="{{$trip->id}}">{{$trip->translate()->name}}</option> 
                    @endforeach
                </select>
            </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary btn-block py-3"
                                    type="submit">{{ __('messages.Submit Suggestion') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
