@props(['published' =>false, 'penname' => '', 'cover' => 'https://api.lorem.space/image/movie?w=200&h=280', 'href' => '#'])
<div class="{{$penname}}">
    <div style="background:url('{{$cover}}');background-position:center;background-size:cover;" class="border overflow-hidden relative  w-24 h-32 rounded mr-2 mt-0 mb-1 hover:scale-110 ease-in duration-100">
        @if ($published)
            <img src="/img/icons/dashboard/check-circle.svg" class="w-4 h-4 position absolute top-2 right-2" alt="">
        @endif
    </div>
    <div class="text-center w-24 text-xs">
        <a href="{{$href}}" class="hover:underline">
            {{$slot}}
        </a>
    </div>
</div>
{{-- https://api.lorem.space/image/movie?w=200&h=280 --}}
