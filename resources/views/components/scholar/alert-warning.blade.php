@props(['fade' => true, 'id' => \Str::random(16)])
<div class="bg-yellow-200 text-yellow-900 p-2 " id="{{$id}}">
    <div class="flex justify-between">
       <div class="flex w-8/12">
            <img src="/img/icons/dashboard/info.svg" alt="">
            <span class="ml-2">{{$slot}}</span>
       </div>
       <div>
           {{$option ?? ''}}
       </div>
    </div>
</div>
