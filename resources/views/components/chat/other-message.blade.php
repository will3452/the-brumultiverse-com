@props(['avatar'=>'', 'message'=>null])
<div class="flex items-start my-1">
    <x-chat.avatar src="{{$avatar}}"/>
    {{-- other message --}}
    <div class="text-right">
        <div class="text-left bg-gray-300 p-2 px-4 mx-2 text-sm w-auto max-w-md">
            {{$slot}}
        </div>
        <small class="text-xs">{{optional($message)->created_at ?? now()->diffForHumans()}}</small>
    </div>
</div>
