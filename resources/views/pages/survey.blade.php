{{-- @extends('pages.master')

@section('content')
    


    <div class="w-full max-w-md mx-auto mt-10">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/survies/{{$survey->name}}" enctype="multipart/form-data">
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
                <div id="additional-inputs2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            {{$survey->name}}
                        </label><br>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            {{$survey->desc}}
                        </label><br>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Enter Your Opinion
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter your opinion" name="opinion"></textarea>
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
                    <form method="POST" action="/survies/{{$survey->name}}" >
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
                       
                        <label for=""><b><h4>{{$survey->name}}</h4></b></label><br>
                        <label for=""><b><h5>{{$survey->desc}}</h5></b></label><br>
                            <div class="form-group">
                                <textarea class="form-control p-4" name="opinion" required placeholder="{{__('messages.Enter Your Opinion')}}"></textarea>
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
