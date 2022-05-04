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
                <table class="table w-full">
                    <tr>
                        <th class="text-left mr-2 font-bold">
                            Title
                        </th>
                        <td>
                            {{$work->title}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left mr-2 font-bold">
                            Category
                        </th>
                        <td>
                            {{$work->category->name}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left mr-2 font-bold">
                            Author
                        </th>
                        <td>
                            {{$work->account->penname}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left mr-2 font-bold">
                            Description
                        </th>
                        <td class="text-sm font-mono max-h-40 overflow-y-auto">
                            {!!$work->blurb!!}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left mr-2 font-bold">
                            Rating
                        </th>
                        <td class="text-sm font-mono max-h-40 overflow-y-auto ">
                            <div class="rating rating-sm">
                                <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                                <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400" checked>
                                <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                                <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                                <input type="radio" name="rating-1" disabled class="mask mask-star-2 bg-orange-400">
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="my-4">
            <a href="javascript:alert('under dev')" class="btn btn-secondary">PREVIEW</a>
            <a href="javascript:alert('under dev')" class="btn btn-primary">ADD TO COLLECTION</a>
        </div>
    </div>
</body>
</html>
