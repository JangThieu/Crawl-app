@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
            <div class="bg-white rounded-2xl shadow-2xl flex w-2/3 max-w-2xl justify-center">
                <div class="w-3/5 p-5">
                    <div class="py-10">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="text-3xl font-bold text-green-500 mb-2">
                                Sign in to Account
                            </h2>

                            <div class="border-2 w-10 border-green-500 inline-block mb-2"></div>
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 w-64 p-2 flex items-center mb-3">
                                    <i class="fa-solid fa-envelope text-gray-400 m-2"></i>
                                    <input type="email" name="email" placeholder="Email"
                                        class="bg-gray-100 outline-none text-sm flex-1 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="bg-gray-100 w-64 p-2 flex items-center mb-3">
                                    <i class="fa-solid fa-lock text-gray-400 m-2"></i>
                                    <input type="password" name="password" placeholder="Password"
                                        class="bg-gray-100 outline-none text-sm flex-1 @error('password') is-invalid @enderror"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="border-2 border-green-500 text-green-500 rounded-full px-12 py-2 inline-block font-semibold hover:bg-green-500 hover:text-white">
                                    {{ __('Login') }}
                                </button>

                                <div class="flex flex-col items-center mt-4">
                                    <p class="italic font-semibold">
                                        Join us now.
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="ml-1 text-green-500 hover:underline">Register here</a>
                                        @endif
                                    </p>
                                    <p class="italic font-semibold">
                                        Lost your password?
                                        @if (Route::has('password.request'))
                                            <a class="ml-1 text-green-500 hover:underline"
                                                href="{{ route('password.request') }}">Forgot
                                                Password?</a>
                                        @endif
                                    </p>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
