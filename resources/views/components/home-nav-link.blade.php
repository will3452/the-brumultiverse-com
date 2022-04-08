@props(['href'=>'#', 'isActive' => false])
<li class="mx-2 block md:inline-block rounded {{$isActive ? 'bg-gradient-to-br from-purple-900 to-blue-900' : ''}} text-sm uppercase px-4 py-2">
    <a href="{{$href}}">
        {{$slot}}
    </a>
</li>
