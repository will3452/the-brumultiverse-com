<x-scholar.layout>
    <x-scholar.page.title>
        My Books
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
                    'label' => 'Books',
                ]
            ]
        "
    />

    <x-scholar.page.index
    type="Book"
    data="books"
    view="scholar.book.index"
    :model="$books" :creation-link="route('scholar.book.create')" title="My Books">
        @if (request()->has('keyword'))
            <x-scholar.work-card-collection href="/scholars/books" :data="$books" />
        @else
                @foreach ($accounts as $account)
                    <div class="mt-4">
                        <div class="mb-4">
                            <x-scholar.material-title icon="/img/icons/dashboard/user.svg" :title="$account->penname" />
                        </div>
                        <x-scholar.work-card-collection href="/scholars/books" :data="$account->books" />
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
