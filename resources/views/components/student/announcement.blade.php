@if (\App\Models\Marquee::count())
<div class="bg-yellow-200">
    <marquee behavior="" direction="" class="text-yellow-900 text-sm ">
        {{implode('***', \App\Models\Marquee::get()->pluck('content')->toArray())}}
    </marquee>
</div>
@endif
