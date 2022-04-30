<x-scholar.layout>
    <x-scholar.page.title>
        My Songs
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Songs',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="Song"
    data="songs"
    view="scholar.song.index"
    :model="$songs" :creation-link="route('scholars.song.create')" title="My Songs">
        @if (request()->has('keyword'))
            <x-scholar.work-card-collection href="/scholar/songs" :data="$songs" />
        @else
                @foreach ($accounts as $account)
                    <div class="mt-4">
                        <div class="mb-4">
                            <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                        </div>
                        <x-scholar.work-card-collection href="/scholar/songs" :data="$account->songs" />
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
