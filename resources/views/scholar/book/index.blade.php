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
        <div class="mt-4 flex flex-wrap justify-start">
            @foreach ($books as $b)
                <x-scholar.work-card href="{{route('scholar.book.show', ['book' => $b->id])}}" cover="{{optional($b->cover)->getSize()}}">
                    {{$b->title}}
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
