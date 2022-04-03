@props(['click' => '', 'disabled' => false , 'id' => \Str::random(6), 'extra' => ''])
<div x-data="{
    isLoading:false,
}">
    <button id="{{$id}}" {{$disabled ? 'disabled' : ''}} x-on:click="{{$click}}" type="submit" class="btn-student-active">
        {{$slot}}
    </button>
</div>
