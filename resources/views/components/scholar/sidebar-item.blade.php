@props(['href' => '#', 'label' => 'demo', 'active' => $href === url()->current()])
<li class="uppercase text-sm">
    <a href="{{$active ? "#":$href}}"
        class="h-12 {{$active ? 'bg-gray-900 text-white' : 'bg-gray-300'}} hover:bg-gray-700 hover:text-white flex items-center justify-center block w-full">
        {{$label}}
    </a>
</li>
