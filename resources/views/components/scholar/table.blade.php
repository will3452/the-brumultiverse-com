@props(['label'])
<div class="overflow-x-auto">
    <div class="flex justify-between">
        <x-scholar.page.title>
            {{$label}}
        </x-scholar.page.title>
        <div>
            {{$option??''}}
        </div>
    </div>
    <table class="table table-compact w-full mt-2">
        {{$slot}}
    </table>
</div>
