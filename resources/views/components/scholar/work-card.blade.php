@props(['penname' => '', 'cover' => 'https://api.lorem.space/image/movie?w=200&h=280', 'href' => '#'])
<div class="{{$penname}}">
    <div style="background:url('{{$cover}}');background-position:center;background-size:cover;" class="border overflow-hidden relative  w-24 h-32 rounded m-4 mt-0 mb-1 ml-0 hover:scale-110">
    </div>
    <div class="text-left w-24 text-xs">
        <a href="{{$href}}" class="hover:underline">
            {{$slot}}
        </a>
    </div>
</div>
{{-- https://api.lorem.space/image/movie?w=200&h=280 --}}
