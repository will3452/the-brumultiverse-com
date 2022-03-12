<!DOCTYPE html>
<html lang="en"  data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="/js/app.js"></script>
</head>
<body>
    <x-scholar.navbar></x-scholar.navbar>
    <div id="app">
        <x-scholar.container>
            {{$slot}}
        </x-scholar.container>
    </div>
</body>
</html>
