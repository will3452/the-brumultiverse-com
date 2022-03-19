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
                    'label' => 'Audio Books',
                ]
            ]
        "
    />

    <x-scholar.page.index :model="$audioBooks" :creation-link="route('scholar.audiobook.create')" title="My Audio Books">
        <div class="mt-4 flex flex-wrap justify-start">
            @foreach ($audioBooks as $b)
                <x-scholar.work-card href="{{route('scholar.audiobook.show', ['audio' => $b->id])}}" cover="{{optional($b->cover)->getSize()}}">
                    {{$b->title}}
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
