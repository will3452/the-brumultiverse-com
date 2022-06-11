
{{-- @if (\App\Models\SlidingBanner::count()) --}}
@if(false)
<div class="slider ">
    @foreach (\App\Models\SlidingBanner::get() as $item)
    <div style="background:url('/storage/{{optional(optional($item)->media)->path}}')" class="flex justify-center items-center">
        <div class="flex justify-center items-center backdrop-filter backdrop-blur">
            <img src="/storage/{{optional(optional($item)->media)->path}}" alt="" class="w-12 md:w-8/12 "  style=" margin:auto; height:350px;object-fit:cover;">
        </div>
    </div>
    @endforeach
</div>
@endif
