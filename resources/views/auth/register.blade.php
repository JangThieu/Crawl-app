@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
            <div class="bg-white rounded-2xl shadow-2xl flex w-2/3 max-w-2xl justify-center">
                <div class="w-3/5 p-5">
                    <div class="py-10">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h2 class="text-3xl font-bold text-green-500 mb-2">
                                Sign Up
                            </h2>

                            <div class="border-2 w-10 border-green-500 inline-block mb-2"></div>
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 w-64 p-2 flex items-center mb-3">
                                    <i class="fa-solid fa-user text-gray-400 m-2"></i>
                                    <input type="name" name="name" placeholder="Name"
                                        class="bg-gray-100 outline-none text-sm flex-1 @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

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
                                    <input id="password" type="password" name="password" placeholder="Password"
                                        class="bg-gray-100 outline-none text-sm flex-1 @error('password') is-invalid @enderror"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="bg-gray-100 w-64 p-2 flex items-center mb-3">
                                    <i class="fa-solid fa-lock text-gray-400 m-2"></i>
                                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password"
                                        class="bg-gray-100 outline-none text-sm flex-1 @error('password') is-invalid @enderror"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="border-2 border-green-500 text-green-500 rounded-full px-12 py-2 inline-block font-semibold hover:bg-green-500 hover:text-white">
                                    {{ __('Register') }}
                                </button>

                                <div class="flex flex-col items-center mt-4">
                                    <p class="italic font-semibold">
                                        Have any account?
                                        @if (Route::has('login'))
                                            <a href="{{ route('login') }}" class="ml-1 text-green-500 hover:underline">Login
                                                here</a>
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
