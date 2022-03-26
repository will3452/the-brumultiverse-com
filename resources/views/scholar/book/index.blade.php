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
            <div class="mt-4 flex flex-wrap justify-start">
                @foreach ($books as $b)
                    <x-scholar.work-card href="{{route('scholar.book.show', ['book' => $b->id])}}" cover="{{optional($b->cover)->getSize()}}">
                        {{$b->title}}
                    </x-scholar.work-card>
                @endforeach
            </div>
        @else
                @foreach ($accounts as $account)
                    <div class="mt-2">
                        <h2 class="font-bold tracking-wider">{{$account->penname}}</h2>
                        <div class=" my-1 flex flex-wrap justify-start">
                            @foreach ($account->books as $b)
                                <x-scholar.work-card href="{{route('scholar.book.show', ['book' => $b->id])}}" cover="{{optional($b->cover)->getSize()}}">
                                    {{$b->title}}
                                </x-scholar.work-card>
                            @endforeach
                        </div>
                    </div>
                @endforeach
        @endif
    </x-scholar.page.index>
</x-scholar.layout>
