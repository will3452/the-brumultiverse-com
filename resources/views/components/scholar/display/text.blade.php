@props(['label' => ''])
<div class="my-2 flex items-center">
    <div class="text-xs uppercase">
        {{$label}} :
    </div>
    <div class="text-sm pl-4">
        {{$slot}}
    </div>
</div>
