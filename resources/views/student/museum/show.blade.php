<!DOCTYPE html>
<html lang="en" data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
    <div>
        <div class="flex items-start">

            <img style="width:200px;" src="{{$work->artFile ? optional($work->artFile)->withWatermark() : optional($work->cover)->withFrame()}}" alt="" />

            <div class="flex-1 mx-4 p-4 rounded shadow-md">
                <div>
                    <span class="font-bold">
                        Title :
                    </span>
                    {{$work->title}}
                </div>
                {{-- <div>
                    <span class="font-bold">
                        Category :
                    </span>
                    {{$work->category->name}}
                </div> --}}
                <div>
                    <span class="font-bold">
                        Author:
                    </span>
                    {{$work->account->penname}}
                </div>
                <div>
                    <span class="font-bold">
                        Description:
                    </span>
                    <div  style="max-height:300px;" class="overflow-y-auto">
                        {!!\Str::limit($work->description, 200)!!}
                    </div>
                </div>
               @if (false)
                   {{-- show if the rating is able --}}
                   <div class="rating rating-sm">
                    <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                    <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400" checked>
                    <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                    <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                    <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                </div>
               @endif
            </div>
        </div>
        <div class="my-4">
            <a href="javascript:alert('phone is under dev :)')" class="btn btn-primary">ADD TO COLLECTION</a>
        </div>
    </div>
</body>
</html>