@props(['label' => '', 'responsive' => true])
<div class="overflow-x-auto" >
    <div class="flex justify-between">
        <x-scholar.page.title>
            {{$label}}
        </x-scholar.page.title>
        <div>
            {{$option??''}}
        </div>
    </div>
    <table class="{{$responsive ? 'table' : 'text-left'}} table-compact w-full mt-2 dark:text-black">
        {{$slot}}
    </table>
</div>
