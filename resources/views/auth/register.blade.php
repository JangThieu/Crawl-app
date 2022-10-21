@extends('layouts.app')

@section('content')
    <div class="h-screen font-sans login bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('register') }}">
                        @csrf
                        <p class="text-gray-800 font-medium">Register</p>
                        <div class="mt-4">
                            <input type="name" name="name" placeholder="Name"
                                class="w-full px-3 py-1 text-gray-700 bg-gray-200 rounded @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="email" name="email" placeholder="Email"
                                class="w-full px-3  py-1 text-gray-700 bg-gray-200 rounded @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input id="password" type="password" name="password" placeholder="Password"
                                class="w-full px-3 py-1 text-gray-700 bg-gray-200 rounded @error('password') is-invalid @enderror"
                                required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input id="password-confirm" type="password" name="password_confirmation"
                                placeholder="Confirm Password"
                                class="w-full px-3 py-1 text-gray-700 bg-gray-200 rounded @error('password') is-invalid @enderror"
                                required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Register</button>
                        </div>
                        @if (Route::has('login'))
                            <a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800"
                                href="{{ route('login') }}">
                                Already have an account ?
                            </a>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
