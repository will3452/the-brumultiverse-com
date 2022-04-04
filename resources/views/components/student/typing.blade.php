@props(['clear'=>true, 'class' => 'text-md text-white mb-4', 'id' => "writer" . \Str::random(6), 'message' => '', 'delay' => 1, 'loop' => false, 'pause' => 500])
<div x-data="{
    tw: null,
    init() {
        const intro = document.querySelector('#{{$id}}');
        this.tp = new Typewriter(intro, {
            loop: {{$loop ? 1: 0}},
            delay:{{$delay}},
        })
            @foreach(\Arr::wrap($message) as $m)
                @if($loop->first)
                    this.tp
                @endif
                    .typeString(`{{$m}}`)
                    .pauseFor({{$pause}})
                @if($clear)
                    .deleteAll()
                    .changeDeleteSpeed(1)
                @endif
            @endforeach
            .start();
    }
}">
    <div id="{{$id}}" class="{{$class}}">
    </div>
</div>
