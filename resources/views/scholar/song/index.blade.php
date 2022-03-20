<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Songs',
                ]
            ]
        "
    />

    <x-scholar.page.index :model="$songs" :creation-link="route('scholar.song.create')" title="My Songs">
        <div class="mt-4 flex flex-wrap justify-start">
            @foreach ($songs as $s)
                <x-scholar.work-card href="{{route('scholar.song.show', ['song' => $s->id])}}" cover="{{optional($s->cover)->getSize()}}">
                    {{$s->title}}
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
