<x-scholar.layout>
    <x-scholar.page.title>
        My Podcasts
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Podcasts',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="Podcast"
    data="podcasts"
    view="scholar.podcast.index"
    :model="$podcasts" :creation-link="route('scholar.podcast.create')" title="My Songs">
        <div class="mt-4 flex flex-wrap justify-start">
            @foreach ($podcasts as $p)
                <x-scholar.work-card href="{{route('scholar.podcast.show', ['podcast' => $p->id])}}" cover="{{optional($p->cover)->getSize()}}">
                    {{$p->title}}
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
