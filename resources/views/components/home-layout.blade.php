@props(['title' => 'Welcome'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brumultiverse | {{$title}}</title>
    <link href="/bru_assets/circle_logo.png" rel="icon"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .active {
            background:url('/bru_assets/button_bg.png') !important;
            background-position: right;
            background-size: cover;
        }
    </style>
</head>
<body style="background:#0F021B !important;" class="text-white">
    <div id="app">
        <x-home-nav></x-home-nav>
        {{$slot}}
        <footer>
            <div class="flex justify-center mt-4">
                <img src="/bru_assets/circle_logo.png" alt="circle logo" class="w-20">
            </div>
            <x-home-text-container>
                We’d love for you to join our growing BRU family!
                <h2 class="text-center font-bold text-2xl">
                    BRUMULTIVERSE
                </h2>
                Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
            </x-home-text-container>
        </footer>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
