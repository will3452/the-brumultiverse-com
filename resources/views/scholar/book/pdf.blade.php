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
                    'href' => '#',
                    'label' => 'upload',
                ]
            ]
        "
    />
    <form action="{{route('scholar.book.pdf', ['book' => $book->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-scholar.form.file accept="aplication/*.pdf" name="pdf[]" label="BOOK TITLE PAGE"/>
        <x-scholar.form.file accept="aplication/*.pdf" name="pdf[]" label=" COPYRIGHT PAGE"/>
        <x-scholar.form.file accept="aplication/*.pdf" name="pdf[]" label="ACKNOWLEDGMENT PAGE"/>
        <x-scholar.form.file accept="aplication/*.pdf" name="pdf[]" label="DEDICATION PAGE"/>
        <x-scholar.form.submit>
            Upload Now
        </x-scholar.form.submit>
    </form>
</x-scholar.layout>
