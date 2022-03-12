@props(['message' => null])
<div class="flex items-start my-1 justify-end">
    <div class="text-left">
        <div class="bg-neutral text-white p-2 px-4 mx-2 mr-4 text-sm w-auto max-w-md">
            {{$slot}}
        </div>
        <small class="text-xs">{{optional($message)->created_at ?? now()->diffForHumans()}}</small>
    </div>
</div>
