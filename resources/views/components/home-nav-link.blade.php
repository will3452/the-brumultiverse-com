@props(['href'=>'#', 'isActive' => false])
<li class="mx-4 block md:inline-block rounded {{$isActive ? 'bg-gradient-to-br from-purple-900 to-blue-900' : ''}} uppercase font-bold px-4 py-2">
    <a href="{{$href}}">
        {{$slot}}
    </a>
</li>
