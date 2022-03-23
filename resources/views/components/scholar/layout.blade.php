<!DOCTYPE html>
<html lang="en"  data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <link rel="stylesheet" href="/vendor/pace/flash.css">
    <script src="/js/app.js"></script>
    @stack('head-style')
    @stack('head-script')
</head>
<body>
    <x-scholar.navbar></x-scholar.navbar>
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
    <div id="app">
        <x-scholar.container>
            {{$slot}}
        </x-scholar.container>
    </div>
    <script data-pace-options='{ "ajax": false }' src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    @stack('body-script')
</body>
</html>
