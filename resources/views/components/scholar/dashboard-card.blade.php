@props(['title' => "Untitled", "icon"=>"", "img" => 'https://raw.githubusercontent.com/will3452/bruxxx/main/public/img/card-bg-custom.png', 'href' => '#', 'proceedText' => 'view'])
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
<a href="{{$href}}" class="hover:shadow-xl block w-32 h-32  rounded-md border m-2 p-2 flex items-center justify-center">
    <div>
        <div class="flex justify-center">
            <img src="{{$icon}}" alt="">
        </div>
        <div class="text-center font-bold uppercase text-xs mt-2">
            {{$title}}
        </div>
    </div>
</a>
