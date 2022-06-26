@props(['small' => false, 'backdrop' => true])
@if ($small)
    <div class="@if($backdrop) backdrop-brightness-50 backdrop-blur-sm @endif p-5 z-30 absolute w-full">
        {{$slot}}
    </div>
@else
    <div class="@if($backdrop) backdrop-brightness-50 backdrop-blur-sm @endif p-10 z-30 absolute w-full">
        {{$slot}}
    </div>
@endif
