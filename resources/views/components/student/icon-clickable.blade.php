@props(['class' => '-top-5 w-32 relative', 'active' => '', 'normal' => '', 'href' => 'javascript:alert("under development!")'])
<img x-data="{active:{{url()->current() === $href ? 1:0}}}" src="{{url()->current() === $href ? $active : $normal}}"
            x-on:mouseover="(e) => {
                if (! active) {
                    e.target.src = '{{$active}}';
                }
            }"
            x-on:mouseout="(e) => {
                if (active) {
                    e.target.src = '{{$active}}';
                } else {
                    e.target.src = '{{$normal}}';
                }
            }"
            onclick="window.location.href='{{$href}}'" alt="" class="{{$class}}"
/>
