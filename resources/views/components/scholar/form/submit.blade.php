@props(['disabled' => false , 'id' => \Str::random(6), 'extra' => ''])
<div x-data="{
    isLoading:false,
}">
    <button id="{{$id}}" {{$disabled ? 'disabled' : ''}} type="submit" class="btn {{$extra}}">
        {{$slot}}
    </button>
</div>
