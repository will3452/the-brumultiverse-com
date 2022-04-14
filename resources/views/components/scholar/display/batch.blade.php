@props(['model' => null, 'data' => []])

<div>
    @foreach ($data as $d)
        @if (! isset($d['type']) || $d['type'] === 'text')
            <x-scholar.display.text :label="$d['label']">
                {{$model[$d['name']]}}
            </x-scholar.display.text>
        @endif
    @endforeach
</div>


{{--
    $data = [
        [
            'label' => string,
            'name' => string,
            'type' => //text...
        ]
    ]
    --}}
