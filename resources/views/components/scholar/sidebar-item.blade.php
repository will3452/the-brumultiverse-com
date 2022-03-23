@props(['href' => '#', 'label' => 'demo', 'active' => $href === url()->current()])
<li class="uppercase text-sm">
    <a href="{{$active ? "#":$href}}"
        class="h-12 border-r-4  {{$active ? 'border-purple-900 dark:border-pink-600' : 'border-transparent'}}
        hover:bg-gray-200
        dark:hover:bg-yellow-300
        dark:hover:text-black
        flex items-center justify-start px-4 block w-full">
        {{$label}}
    </a>
</li>
