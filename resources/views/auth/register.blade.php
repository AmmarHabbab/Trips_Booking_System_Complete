{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


{{-- @extends('imports')

@section('content')
<div class="signup-container">
<div class="col-lg-5">
    <div class="card border-0">
        <div class="card-header bg-primary text-center p-4">
            <h1 class="text-white m-0">Sign Up Now</h1>
        </div>
        <div class="card-body rounded-bottom bg-white p-5">
            <form>
                <div class="form-group">
                    <input id="name" class="form-control p-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                </div>
                <div class="form-group">
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
                </div>
                <div class="form-group">
                    <input id="password" class="form-control p-4" type="password"
                    name="password"
                    required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input id="password_confirmation" class="form-control p-4" type="password"
                    name="password_confirmation" required autocomplete="new-password">
                </div>
                <div>
                    <button class="btn btn-primary btn-block py-3" type="submit">Sign Up Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection --}}
@extends('imports')

@section('content')
    <style>
        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
            /* height: 100vh; */
        }
    </style>
    <div class="signup-container">
    <div class="col-lg-5">
        <div class="card border-0">
            <div class="card-header bg-primary text-center p-4">
                <h1 class="text-white m-0">Register</h1>
            </div>
            <div class="card-body rounded-bottom bg-white p-5">
                <form method="POST" action="{{ route('register') }}">
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
                    <label for=""><b>{{ __('messages.Name') }}</b></label><br>
                    <div class="form-group">
                        <input id="name" class="form-control p-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    </div>
                    <label for=""><b>{{ __('messages.Email') }}</b></label><br>
                    <div class="form-group">
                        <input id="email" class="form-control p-4" type="email" name="email" :value="old('email')" required autocomplete="username">
                    </div>
                    <label for=""><b>{{ __('messages.Password') }}</b></label><br>
                    <div class="form-group">
                        <input id="password" class="form-control p-4" type="password"
                        name="password"
                        required autocomplete="new-password">
                    </div>
                    <label for=""><b>{{ __('messages.Password Confirmation') }}</b></label><br>
                    <div class="form-group">
                        <input id="password_confirmation" class="form-control p-4" type="password"
                        name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3" type="submit">Sign Up Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 