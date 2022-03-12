<!DOCTYPE html>
<html lang="en"  data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.4/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <x-scholar.navbar></x-scholar.navbar>
    <div id="app">
        <x-scholar.container>
            {{$slot}}
        </x-scholar.container>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
