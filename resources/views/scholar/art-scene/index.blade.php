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
        @if (request()->has('keyword'))
            <x-scholar.work-card-collection href="/scholar/art-scenes" :data="$artScenes" />
        @else
                @foreach ($accounts as $account)
                    <div class="mt-4">
                        <div class="mb-4">
                            <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                        </div>
                        <x-scholar.work-card-collection href="/scholar/art-scenes" :data="$account->artScenes" />
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
