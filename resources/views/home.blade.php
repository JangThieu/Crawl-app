@extends('layouts.app')

@section('content')
    <div class="mx-auto bg-[#fff]">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-[#fff]">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm p-2">
                    <div class="container">
                        <a class="navbar-brand pl-2 text-white logo" href="#">
                            <img src="https://mega.com.vn/media/banner/logo_logo%20web.png" alt="" class="logo-img">
                        </a>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-gray-500" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </header>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar"
                    class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <li class=" w-full h-full py-3 px-2 border-b border-300-border ">
                            <a href="{{ route('home') }}"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                                Dashboard
                                <span><i class="fas fa-angle-right float-right"></i></span>
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2">
                            <a href="#"
                                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="far fa-file float-left mx-2"></i>
                                Pages
                                <span><i class="fa fa-angle-down float-right"></i></span>
                            </a>
                            <ul class="list-reset -mx-2 bg-white-medium-dark">
                                <li class="border-t mt-2 border-300-border w-full h-full px-2 py-3">
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}"
                                            class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                            Login Page
                                            <span><i class="fa fa-angle-right float-right"></i></span>
                                        </a>
                                    @endif

                                </li>
                                <li class="border-t border-300-border w-full h-full px-2 py-3">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                            Register Page
                                            <span><i class="fa fa-angle-right float-right"></i></span>
                                        </a>
                                    @endif

                                </li>
                            </ul>
                        </li>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-medium flex-1 p-3 overflow-hidden">

                    <div class="flex flex-col">
                        <!-- Card Sextion Starts Here -->

                        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
                            <div class="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
                                <div class="rounded-2xl shadow-2xl flex w-2/3 max-w-2xl justify-center bg-custom">
                                    <div class="w-4/5 p-5">

                                        <button type="submit" id="run-command" name="runCommand"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-4">
                                            Run Command
                                        </button>

                                        <div class="py-10">
                                            <div class="flex flex-col items-center mt-4" id="showDownload">
                                                <div class="progress-bar" id="progress-bar"></div>
                                                <a href="/download" id="download"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mt-2">
                                                    <i class="fa-solid fa-download mr-2"></i>
                                                    Download File
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                <!--/Main-->
            </div>
            <footer class="bg-[#3d4852] text-white p-2">
                <div class="flex flex-1 mx-auto">&copy; 2019. CÔNG TY TNHH TIN HỌC MEGA. Giấy phép kinh doanh: 0400480223 - do sở KH & ĐT TP. Đà Nẵng cấp ngày: 25/01/2005.
                    All rights reserved.</div>
            </footer>
        </div>

    </div>
@endsection

@section('script')
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('button[id="run-command"]').click(function() {
                $.ajax({
                    url: 'http://localhost:3015/run-command',
                    type: "post",
                    // command: command
                })
            })
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.3/socket.io.js"
        integrity="sha512-iWPnCISAd/J+ZacwV2mbNLCaPGRrRo5OS81lKTVPtRg1wGTC20Cfmp5Us5RcbLv42QLdbAWl0MI57yox5VecQg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var socket = io("http://localhost:3015/", {
            secure: true,
            transports: ["websocket", "polling"]
        })

        socket.on("isRunning", isRunning => {
            if (isRunning) {
                socket.emit("start:job")
            } else {
                socket.emit("end:job")
            }
        })

        $(function() {
            // $('#showDownload').fadeIn(1000);
            $("button[id=run-command]").click(function() {
                socket.emit("start:job");
            })
        })

        socket.on('connect:server', function(data) {
            console.log(data);
        })

        socket.on("valueOn", data => {
            const progressBar = document.getElementById("progress-bar");
            var percent = (parseFloat(data['totalLink']) / parseFloat(data['targetLink'])) * 100;
            if (data.targetLink == '0') {
                progressBar.dataset.status = 0 + "%";
                progressBar.setAttribute(
                    "style",
                    `--__progress-bar__status_wh: ${0}%;`
                );
            } else {
                progressBar.dataset.status = Math.floor(percent) + "%";
                progressBar.setAttribute(
                    "style",
                    `--__progress-bar__status_wh: ${percent}%;`
                );
            }

            if (Math.floor(percent) > 95) {
                progressBar.dataset.status = 100 + "%";
                progressBar.setAttribute(
                    "style",
                    `--__progress-bar__status_wh: ${100}%;`
                );
                socket.emit("end:job");
            }

            console.log({
                data
            })
        })
    </script>
@endsection
