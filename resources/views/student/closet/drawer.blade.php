<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawer</title>
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="/js/app.js"></script>
</head>
<body>
    <div id="app">
        {{-- {{auth()->user()->avatar}} --}}
        <update-dress :current-avatar="{{auth()->user()->avatar}}" gender="{{request()->gender ?? auth()->user()->gender}}" is-premium="{{is_null(request()->premium) ? auth()->user()->isPremium(): request()->premium}}" college="{{auth()->user()->interest->college->name}}"></update-dress>
    </div>
</body>
</html>
