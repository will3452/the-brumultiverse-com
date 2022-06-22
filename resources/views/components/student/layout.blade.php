@props(['bg' => 'bg-black'])
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>BRUMULTIVERSE</title>
    @stack('head-script')
    <link href="/css/app.css" rel="stylesheet"/>
    <script src="/js/app.js" defer></script>
    <x-vendor.alpinejs/>
    <x-vendor.typewriterjs/>
</head>
<body class="relative {{$bg}} max-h-screen">
    @include('sweetalert::alert')
    {{-- <x-student.loader/> --}}
    <div class="w-full relative mx-auto overflow-hidden max-h-screen" >
        {{-- <x-student.topbar/> --}}
            {{$slot}}
        <x-student.bottombar/>
        @auth
            <a href="{{route('dev.blank', ['name' => 'Shop'])}}" class="px-2 py-1 fixed bottom-3 right-10">
                <img src="/students/nav/store.png" alt="" class="h-9">
            </a>
            <a href="/scholars/logout" class="px-2 py-1 text-bold rounded text-white fixed bottom-4 right-2 bg-red-600">
                <img class="invert" src="/img/icons/crud/out.svg" alt="">
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
    <script>
        @guest
            window.onload =  function () {
                document.getElementById('loginForm').click()
                document.getElementById('loader-container').style.display = 'none';
            }
        @else
            window.onload =  function () {
                document.getElementById('loader-container').style.display = 'none';
            }
        @endguest
    </script>
    @stack('body-script')
</body>
</html>
