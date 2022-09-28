<div class="bg-white p-2 rounded-xl shadow-xl w-5/12 font-mono my-2">
    <div class="font-bold flex justify-between">
        <span>
            {{$item->title}}
        </span>
        <small>
            {{$item->created_at->format('H:i a')}}
        </small>
    </div>
    <div>
        @if ($showMore)
            {{$item->content}}
            @if (strlen($item->content) > 100)
                <button class="btn btn-link btn-sm" wire:click="showToggle">show less</button>
            @endif
        @else
            {{Str::limit($item->content, 100)}}
            @if (strlen($item->content) > 100)
                <button class="btn btn-link btn-sm" wire:click="showToggle">show more</button>
            @endif
        @endif
    </div>
</div>
