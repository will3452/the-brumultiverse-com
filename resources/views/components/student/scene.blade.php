@props(['blur' => false])
<div class="absolute top-0 bottom-0 w-full z-0 {{$blur ? 'backdrop-blur-sm' : ''}}">
    {{$slot}}
</div>
