@props(['href' => '#', 'label' => 'demo', 'active' => $href === url()->current()])
<li class="uppercase text-sm">
    <a href="{{$active ? "#":$href}}"
        class="h-12 border-r-4  {{$active ? 'border-purple-900' : 'border-transparent'}} hover:bg-gray-200 flex items-center justify-start px-4 block w-full">
        {{$label}}
    </a>
</li>
