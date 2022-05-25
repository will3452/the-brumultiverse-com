@props(['small' => false])
@if ($small)
    <div class="backdrop-brightness-50 backdrop-blur-sm p-5 z-30 absolute w-full">
        {{$slot}}
    </div>
@else
    <div class="backdrop-brightness-50 backdrop-blur-sm p-10 z-30 absolute w-full">
        {{$slot}}
    </div>
@endif
