{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


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
                <form method="POST" action="{{ route('login') }}">
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
                    <label for=""><b>{{ __('messages.Email') }}</b></label><br>
                    <div class="form-group">
                        <input id="email" class="form-control p-4" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    </div>
                    <label for=""><b>{{ __('messages.Password') }}</b></label><br>
                    <div class="form-group">
                        <input id="password" class="form-control p-4" type="password"
                        name="password"
                        required autocomplete="current-password">
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3" type="submit">Login Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 