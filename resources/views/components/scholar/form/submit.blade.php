@props(['disabled' => false , 'id' => \Str::random(6)])
<button id="{{$id}}" {{$disabled ? 'disabled' : ''}} type="submit" class="btn">
    {{$slot}}
</button>
