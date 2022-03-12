<x-home-layout>

    <div class="text-center">
        <h2 class="text-center text-4xl uppercase font-bold my-8">
            BRUNITY
        </h2>
    </div>

    @foreach (\App\Models\Brunity::get() as $item)
        <x-home-text-container>
            <div class="w-full flex items-center border-4 border-gray-900 bg-gradient-to-br from-blue-900 to-purple-900">
                <img src="/storage/{{$item->cover->path}}" alt="" class="w-32">
                <div class="ml-4 font-serif text-left">
                    <h1 class="text-2xl">
                        {{$item->name}}
                    </h1>
                    <h3>
                        {{$item->title}}
                    </h3>
                    <div class="flex text-xs justify-start mt-2 items-center">
                        <div class="mr-4">
                            Follow me @
                        </div>
                        <div class="mr-4 bg-purple-800 text-white p-2">
                            <a target="_blank" href="{{$item->facebook_link}}">Facebook</a>
                        </div>
                        <div class="mr-4 bg-purple-800 text-white p-2">
                            <a target="_blank" href="{{$item->youtube_link}}">Youtube</a>
                        </div>
                        <div class="mr-4 bg-purple-800 text-white p-2">
                            <a target="_blank" href="{{$item->instagram_link}}">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </x-home-text-container>
    @endforeach
</x-home-layout>
