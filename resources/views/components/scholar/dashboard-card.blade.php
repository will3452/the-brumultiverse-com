@props(['title' => "Untitled", 'fixing' => false, "icon"=>"", "img" => 'https://raw.githubusercontent.com/will3452/bruxxx/main/public/img/card-bg-custom.png', 'href' => '#', 'proceedText' => 'view'])
{{-- <div class="card w-96 bg-base-100 shadow-xl image-full m-1">
    <figure><img src="{{$img}}" alt="{{$title}}"></figure>
    <div class="card-body">
        <h2 class="card-title capitalize">{{$title}}</h2>
        <p>{{$slot}}</p>
        <div class="card-actions justify-end">
        <a class="btn btn-primary btn-sm" href="{{$href}}">{{$proceedText}}</a>
        </div>
    </div>
</div> --}}
<a href="{{$fixing ? '#' : $href}}" x-data="{isHover:false}" x-on:mouseover="isHover = true" x-on:mouseout="isHover = false" class="overflow-hidden relative hover:shadow-xl hover:bg-base-200  block w-32 h-32 dark:hover:bg-black border m-2 p-2 flex items-center  justify-center">
    @if($fixing)
        <div class="absolute rotate-45 bg-base-200  w-full text-center top-2 -right-10 font-bold uppercase text-sm">fixing</div>
    @endif
    <div >
        <div class="flex justify-center">
            <img src="{{$icon}}" alt="" x-bind:class="{'animate-bounce':isHover}">
        </div>
        <div class="text-center font-bold uppercase text-xs mt-2 ">
            {{$title}}
        </div>
    </div>

</a>
