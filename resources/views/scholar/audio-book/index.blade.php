<x-scholar.layout>
    <x-scholar.page.title>
        My Audio books
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
                    'label' => 'Audio Books',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="AudioBook"
    data="audioBooks"
    view="scholar.audio-book.index"
    :model="$audioBooks" :creation-link="route('scholar.audiobook.create')" title="My Audio Books">
        @if (request()->has('keyword'))
            <x-scholar.work-card-collection href="/scholars/audio-books" :data="$audioBooks" />
        @else
                @foreach ($accounts as $account)
                    <div class="mt-4">
                        <div class="mb-4">
                            <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                        </div>
                        <x-scholar.work-card-collection href="/scholars/audio-books" :data="$account->audioBooks" />
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
