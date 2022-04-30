<x-scholar.layout>
    <x-scholar.page.title>
        My Films
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
                    'label' => 'Films',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="Film"
    data="films"
    view="scholar.film.index"
    :model="$films" :creation-link="route('scholar.film.create')" title="My Films">
        <div class="mt-4 flex flex-wrap justify-start">
            @if (request()->has('keyword'))
                <x-scholar.work-card-collection href="/scholars/films" :data="$films" />
            @else
                    @foreach ($accounts as $account)
                        <div class="mt-4">
                            <div class="mb-4">
                                <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                            </div>
                            <x-scholar.work-card-collection href="/scholars/films" :data="$account->films" />
                        </div>
                    @endforeach
            @endif
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
