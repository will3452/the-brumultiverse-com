@props(['title' => ''])
<div class="shadow-lg border rounded p-4">
    <h1 class="text-xl uppercase font-bold mb-2">
        {{$title}}
    </h1>
    {{$slot}}
</div>
