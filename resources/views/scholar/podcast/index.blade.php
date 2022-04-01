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
        @if (request()->has('keyword'))
            <x-scholar.work-card-collection href="/scholar/podcasts" :data="$podcasts" />
        @else
                @foreach ($accounts as $account)
                    <div class="mt-4">
                        <div class="mb-4">
                            <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                        </div>
                        <x-scholar.work-card-collection href="/scholar/podcasts" :data="$account->podcasts" />
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
