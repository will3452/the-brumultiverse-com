<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRUMULTIVERSE</title>
    <link href="/css/app.css" rel="stylesheet"/>
    <script src="/js/app.js" defer></script>
    <x-vendor.alpinejs/>
    <x-vendor.typewriterjs/>
</head>
<body class="relative bg-black max-h-screen">
    <div class="w-full max-w-sm relative mx-auto overflow-hidden max-h-screen">
        <x-student.topbar/>
            {{$slot}}
        <x-student.bottombar/>
    </div>
    @stack('body-script')
</body>
</html>
