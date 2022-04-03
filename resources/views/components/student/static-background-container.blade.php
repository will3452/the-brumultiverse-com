@props(['bg' => '/students/static-bg.png', 'blur' => false])
<div
    class="w-full bg-gray-200 my-24 {{$blur ? 'backdrop-blur-sm' : ''}}"
    style="background:url('{{$bg}}');background-position:center;background-attachment:fixed;background-size:contain;"
    >
    <div class="h-screen">
        {{$slot}}
    </div>
</div>
