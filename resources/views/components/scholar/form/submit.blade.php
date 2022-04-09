@props(['disabled' => false , 'id' => \Str::random(6), 'extra' => ''])
<div x-data="{
    isLoading:false,
}">
    <button id="{{$id}}" {{$disabled ? 'disabled' : ''}} type="submit" class="btn {{$extra}} bg-gradient-to-r from-purple-900 to-blue-900 text-white tracking-widest border-0">
        {{$slot}}
    </button>
</div>
