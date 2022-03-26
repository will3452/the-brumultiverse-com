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
            @foreach ($films as $f)
                <x-scholar.work-card published="{{! is_null($f->published_at)}}" href="{{route('scholar.film.show', ['film' => $f->id])}}" cover="{{optional($f->cover)->getSize()}}">
                    {{$f->title}}
                </x-scholar.work-card>
            @endforeach
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
