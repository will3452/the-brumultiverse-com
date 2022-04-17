<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.book.index'),
                    'label' => 'Books',
                ],
                [
                    'href' => route('scholar.book.show', ['book' => $book->id]),
                    'label' => $book->title,
                ],
                [
                    'href' => route('scholar.book.chapters', ['book' => $book->id]),
                    'label' => 'Chapters',
                ],
                [
                    'href' => '#',
                    'label' => 'Prologue',
                ]
            ]
        "
    />
    <x-scholar.page.title>
        Prologue
    </x-scholar.page.title>
    <form action="{{route('scholar.prologue.update', ['prologue' => $prologue])}}" method="POST">
        @csrf
        @method("PUT")
        <x-scholar.form.ckeditor name="body" label="Content">{{$prologue->body}}</x-scholar.form.ckeditor>
        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
    <x-vendor.ckeditor/>
</x-scholar.layout>
