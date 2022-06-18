@props(['label' => '', 'value' => 0, 'class' => 'w-24 relative', 'active' => '', 'normal' => '', 'href' => 'javascript:alert("under development!")'])

<div x-data="{active:{{url()->current() === $href ? 1:0}}}"
            x-on:mouseover="(e) => {
                if (! active) {
                    e.target.style.background = url('{{$active}}');
                }
            }"
            x-on:mouseout="(e) => {
                if (active) {
                    e.target.style.background = url('{{$active}}');
                } else {
                    e.target.style.background = url('{{$normal}}');
                }
            }"
            onclick="window.location.href='{{$href}}'" alt="" class="{{$class}}"
>
hello
</div>
{{-- <div class="text-white font-mono text-sm">
    {{$label}} : {{$value}}
</div> --}}
