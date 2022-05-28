
@if (\App\Models\SlidingBanner::count())
<div class="slider ">
    @foreach (\App\Models\SlidingBanner::get() as $item)
    <div style="background:url('/storage/{{$item->media->path}}')" class="flex justify-center items-center">
        <div class="flex justify-center items-center backdrop-filter backdrop-blur">
            <img src="/storage/{{$item->media->path}}" alt="" class="w-12 md:w-8/12 "  style=" margin:auto; height:350px;object-fit:cover;">
        </div>
    </div>
    @endforeach
</div>
@endif
