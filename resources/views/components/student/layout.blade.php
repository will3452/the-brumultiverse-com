<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRUMULTIVERSE</title>
    @stack('head-script')
    <link href="/css/app.css" rel="stylesheet"/>
    <script src="/js/app.js" defer></script>
    <x-vendor.alpinejs/>
    <x-vendor.typewriterjs/>
    <style>
        * {
        box-sizing: border-box;
        }

        body {
        background: rebeccapurple;
        }

        h1.loader {
        color: #FFFFFF;
        text-align: center;
        font-family: sans-serif;
        text-transform: uppercase;
        font-size: 20px;
        position: relative;
        }

        h1:after {
        position: absolute;
        content: "";
        -webkit-animation: Dots 2s cubic-bezier(0, .39, 1, .68) infinite;
        animation: Dots 2s cubic-bezier(0, .39, 1, .68) infinite;
        }

        #loader-container {
            width:100vw;
            height:100vh;
            background:#442277;
            position: fixed;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .loader {
        margin: 5% auto 30px;
        top:0px;
        }

        .book {
        border: 4px solid #FFFFFF;
        width: 60px;
        height: 45px;
        position: relative;
        perspective: 150px;
        }

        .page {
        display: block;
        width: 30px;
        height: 45px;
        border: 4px solid #FFFFFF;
        border-left: 1px solid #8455b2;
        margin: 0;
        position: absolute;
        right: -4px;
        top: -4px;
        overflow: hidden;
        background: #8455b2;
        transform-style: preserve-3d;
        -webkit-transform-origin: left center;
        transform-origin: left center;
        }

        .book .page:nth-child(1) {
        -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.6s infinite;
        animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.6s infinite;
        }

        .book .page:nth-child(2) {
        -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.45s infinite;
        animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.45s infinite;
        }

        .book .page:nth-child(3) {
        -webkit-animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.2s infinite;
        animation: pageTurn 1.2s cubic-bezier(0, .39, 1, .68) 1.2s infinite;
        }


        /* Page turn */

        @-webkit-keyframes pageTurn {
        0% {
            -webkit-transform: rotateY( 0deg);
            transform: rotateY( 0deg);
        }
        20% {
            background: #4b1e77;
        }
        40% {
            background: rebeccapurple;
            -webkit-transform: rotateY( -180deg);
            transform: rotateY( -180deg);
        }
        100% {
            background: rebeccapurple;
            -webkit-transform: rotateY( -180deg);
            transform: rotateY( -180deg);
        }
        }

        @keyframes pageTurn {
        0% {
            transform: rotateY( 0deg);
        }
        20% {
            background: #4b1e77;
        }
        40% {
            background: rebeccapurple;
            transform: rotateY( -180deg);
        }
        100% {
            background: rebeccapurple;
            transform: rotateY( -180deg);
        }
        }


            /* Dots */

            @-webkit-keyframes Dots {
            0% {
                content: "";
            }
            33% {
                content: ".";
            }
            66% {
                content: "..";
            }
            100% {
                content: "...";

            content: ".";
        }
        66% {
            content: "..";
        }
        100% {
            content: "...";
        }
        }
    </style>
</head>
<body class="relative bg-black max-h-screen">
    {{-- <x-student.loader/> --}}
    <div class="w-full relative mx-auto overflow-hidden max-h-screen">
        <x-student.topbar/>
            {{$slot}}
        <x-student.bottombar/>
        @auth
            <a href="/scholars/logout" class="px-2 py-1 text-bold rounded text-white fixed bottom-2 right-2 bg-red-600">
                Logout
            </a>
        @endauth
        @guest
            @if (url()->current() == route('student.map'))
            <div class="fixed right-2 bottom-2">
                <x-student.modal button="login" id="loginForm">
                    <form action="{{route('student.login')}}" method="POST" class="backdrop-brightness-50">
                        @csrf
                        <h1 class="text-white text-2xl">Login</h1>
                        <x-student.form.input name="email" label="Email" />
                        <x-student.form.input name="password" label="Password" type="password"/>
                        <div class="my-2">
                            <button class="btn btn-student-active w-full">
                                Login
                            </button>
                        </div>
                       <div class="my-2">
                            <a href="{{route('student.register')}}" class="btn btn-student w-full">
                                Register
                            </a>
                       </div>
                    </form>
                </x-student.modal>
            </div>
            @endif
        @endguest
    </div>

    @stack('body-script')
    <script>
        @guest
            window.onload =  () => {
                setTimeout(() => {
                    document.getElementById('loginForm').click()
                }, 500);
            }
        @endguest
    </script>
</body>
</html>
