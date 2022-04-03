@props(['bg' => '/students/static-bg.png'])
<div
    class="w-full bg-gray-200 my-24"
    style="background:url('{{$bg}}');background-position:center;background-attachment:fixed;background-size:contain;"
    >
    <div style="height:720px;">
        {{$slot}}
    </div>
</div>
