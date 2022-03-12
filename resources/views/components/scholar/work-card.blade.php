@props(['cover' => 'https://api.lorem.space/image/movie?w=200&h=280', 'href' => '#'])
<div>
    <div style="background:url('{{$cover}}');background-position:center;" class="overflow-hidden relative md:w-40 md:h-56 w-24 h-32 rounded shadow m-2">
    </div>
    <div class="text-center md:w-40 w-16 text-xs">
        <a href="{{$href}}" class="hover:underline">
            {{$slot}}
        </a>
    </div>
</div>
{{-- https://api.lorem.space/image/movie?w=200&h=280 --}}
