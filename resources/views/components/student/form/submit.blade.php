@props(['click' => '', 'disabled' => false , 'id' => \Str::random(6), 'extra' => ''])
<div x-data="{
    isLoading:false,
}">
    <button id="{{$id}}" {{$disabled ? 'disabled' : ''}} x-on:click="{{$click}}" type="submit" class="rounded-full btn {{$extra}} btn-sm text-white bg-gradient-to-t from-blue-900 to-purple-900 border-white border-1">
        {{$slot}}
    </button>
</div>
