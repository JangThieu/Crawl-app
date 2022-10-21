@extends('layouts.app')

@section('content')
    <div class="h-screen font-sans login bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST" action="{{ route('login') }}">
                        @csrf
                        <p class="text-gray-800 font-medium text-center text-lg ">Login</p>
                        <div class="">
                            <label class="block text-sm text-gray-00" for="email">Email</label>
                            <input
                                class="w-full px-3 py-1 text-gray-700 bg-gray-200 rounded @error('email') is-invalid @enderror"
                                id="email" name="email" type="text" required placeholder="Email" aria-label="email"
                                value="{{ old('email') }}" autofocus autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600 " for="password">Password</label>
                            <input
                                class="w-full px-3 py-1 text-gray-700 bg-gray-200 rounded @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="******" required >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Login</button>
                            @if (Route::has('password.request'))
                                <a class="inline-block right-0 align-baseline  font-bold text-sm text-500 hover:text-blue-800"
                                    href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif

                        </div>
                        @if (Route::has('register'))
                            <a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800"
                                href="{{ route('register') }}">
                                Not registered ?
                            </a>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
