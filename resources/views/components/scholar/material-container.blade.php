@props(['title' => '', 'icon' => '/img/icons/dashboard/info.svg'])
<div class="mt-4">
    <x-scholar.material-title :icon="$icon" :title="$title"/>
    <div class="flex flex-wrap justify-center md:justify-start">
        {{$slot}}
    </div>
</div>
