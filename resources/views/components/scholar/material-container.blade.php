@props(['title' => ''])
<div class="mt-4">
    <div class="flex items-center">
        <img src="/img/icons/dashboard/info.svg" alt="" width="15">
        <span class="ml-2 font-bold text-gray-900 uppercase text-xs">
            {{$title}}
        </span>
    </div>
    <div class="flex flex-wrap justify-center md:justify-start">
        {{$slot}}
    </div>
</div>
