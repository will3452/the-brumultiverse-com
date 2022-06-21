@props(['label' => '', 'value' => 0, 'class' => 'w-24 relative', 'active' => '', 'normal' => '', 'href' => route('student.buy.crystal')])
<div x-data="{active:{{url()->current() === $href ? 1:0}}}"
     title="{{$label}}"
        style='background: url("{{$normal}}"); background-size:contain;background-repeat:no-repeat;background-position:center' class='top-balance pointer justify-end pr-2 text-xs font-bold flex items-center'
        onclick="window.location.href='{{$href}}'" alt="" class="{{$class}}"
>
{{compressCurrencyFormat($value)}}
</div>
{{-- <div class="text-white font-mono text-sm">
    {{$label}} : {{$value}}
</div> --}}
