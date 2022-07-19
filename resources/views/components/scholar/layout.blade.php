@props(['inApp' => true])
<!DOCTYPE html>
{{-- <html lang="en"  data-theme="night"> --}}
<html lang="en"  data-theme="fantasy">
{{-- <html lang="en"  data-theme="cyberpunk"> --}}
{{-- <html lang="en"  data-theme="lofi"> --}}
{{-- <html lang="en"  data-theme="winter"> --}}
{{-- <html lang="en"  data-theme="pastel"> --}}
<head>
    <x-ads></x-ads>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>BRUMULTIVERSE</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <link rel="stylesheet" href="/vendor/pace/flash.css">
    <link rel="icon" href="{{getAsset('home/circle_logo.png')}}">
    <script src="/js/app.js?v={{now()->today()->format('mdy')}}" defer></script>
    @stack('head-style')
    @stack('head-script')
</head>
<body class="relative bg-base-100">
    @auth
        <x-scholar.navbar></x-scholar.navbar>
    @else
        <x-home-nav/>
    @endif

    @if (session()->has('success'))
        <x-scholar.alert-success>
            {{session()->get('success')}}
        </x-scholar.alert-success>
    @endif

    @auth
        @if (! auth()->user()->hasAccountsApproved() && auth()->user()->hasVerifiedEmail())
            <x-scholar.alert-success fade="0">
                You're all set! Here's your profile page. Create pen names to begin uploading your masterpieces. Once used on any uploaded work, pen names become permanent. Welcome!
            </x-scholar.alert-success>
        @endif
    @endauth
    <div @if($inApp) id="app" @endif class="dark:bg-gray-800 dark:text-white">
        <x-scholar.container>
            <x-slot name="alert">{{$alert ?? ''}}</x-slot>
            {{$slot}}
        </x-scholar.container>
    </div>
    {{-- <x-dev.bug-reporter/> --}}
    <x-dev.tawkto/>
    <x-scholar.page.footer/>
    <script data-pace-options='{ "ajax": false }' src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    @stack('body-script')
</body>
</html>
