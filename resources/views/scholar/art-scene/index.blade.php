<x-scholar.layout>
    <x-scholar.page.title>
        My Art Scenes
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
                    'label' => 'Art Scenes',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="ArtScene"
    data="artScenes"
    view="scholar.art-scene.index"
    :model="$artScenes" :creation-link="route('scholar.artscene.create')" title="My Art Scenes">
        <div class="mt-4 flex flex-wrap justify-start">
            @foreach ($artScenes as $a)
                <x-scholar.work-card href="{{route('scholar.artscene.show', ['art' => $a->id])}}" cover="{{optional($a->artFile)->getSize()}}">
                    {{$a->title}}z
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
