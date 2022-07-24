<!DOCTYPE html>
<html lang="en" data-theme="fantasy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css" />
    <x-vendor.alpinejs/>
    <x-vendor.sweetalertjs/>
</head>
<body>
    <div>
        <div class="flex items-start">

           <div>
                <img style="width:200px;" src="{{$work->artFile ? optional($work->artFile)->withWatermark() : optional($work->cover)->withFrame()}}" alt="" />
                <div class="my-4" x-data="{
                    confirm() {
                        if ('{{$work->type}}' == '{{\App\Models\Book::TYPE_PREMIUM}}') {
                            let c = confirm('Would you like to purchase this book to read continuously without Hall Pass?')
                            if (c) {
                                window.location.href = `{{route('student.purchase.collection', ['type' => getBaseModel(get_class($work)), 'id' => $work->id])}}`
                            } else {
                                window.location.href = `{{route('student.add.to.collection', ['type' => getBaseModel(get_class($work)), 'id' => $work->id])}}`
                            }
                        }

                        if ('{{$work->type}}' == '{{\App\Models\Book::TYPE_PLATINUM}}') {
                            let c = confirm('This book requires purchase for {{$work->cost}} Purple Crystal/s. Would you like to continue?')
                            if (c) {
                                window.location.href = `{{route('student.purchase.collection', ['type' => getBaseModel(get_class($work)), 'id' => $work->id])}}`
                            }
                        }

                        if ('{{$work->type}}' == '{{\App\Models\Book::TYPE_REGULAR}}') {
                            window.location.href = `{{route('student.add.to.collection', ['type' => getBaseModel(get_class($work)), 'id' => $work->id])}}`
                        }
                    }
                }">
                    @if (auth()->user()->canAddToCollection($work))
                        {{-- <a  class="btn btn-primary" href="{{route('student.add.to.collection', ['type' => getBaseModel(get_class($work)), 'id' => $work->id])}}">ADD TO COLLECTION</a> --}}
                        <a  class="btn btn-primary" href="#" x-on:click="confirm" >ADD TO COLLECTION</a>
                    @else
                        @if (auth()->user()->isInStudentCollections($work))
                            <a href="{{route('student.bs.index')}}" class="btn btn-primary">View in my collection</a>
                        @else
                            <a  class="btn btn-disabled">ADD TO COLLECTION</a>
                        @endif
                    @endif
                </div>
           </div>

            <div class="flex-1 mx-4 p-4 rounded shadow-md">
                <div>
                    <span class="font-bold">
                        Title :
                    </span>
                    {{$work->title}}
                </div>
                <div>
                    <span class="font-bold">
                        Category :
                    </span>
                    {{$work->category->name}}
                </div>
                <div>
                    <span class="font-bold">
                        Author :
                    </span>
                    {{$work->account->penname}}
                </div>
                <div>
                    <span class="font-bold">
                        Cost :
                    </span>
                    {{ displayCost($work->cost, $work->cost_type) }}
                </div>
                <div>
                    <span class="font-bold">
                        No. Of Chapters :
                    </span>
                    {{ $work->bookContentChapters()->count() }}
                </div>
                <div>
                    <span class="font-bold">
                        Blurb :
                    </span>
                    <div  style="max-height:300px;" class="overflow-y-auto">
                        {!!$work->blurb!!}
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
    </div>
</body>
</html>
