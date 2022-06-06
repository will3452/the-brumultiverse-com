<x-scholar.layout>
    <x-scholar.page.title>
        Upload Book Content
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.book.index'),
                    'label' => 'Books'
                ],
                [
                    'href' => route('scholar.book.show', ['book' => $book]),
                    'label' => $book->title,
                ]
            ]
        "
    />

    <form action="{{route('scholar.book-content.store')}}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{$book->id}}">
        <x-scholar.form.filepond name="pdf" label="Upload Content (PDF only)" accept="pdf" enable="button[type=submit]"/>
        <x-scholar.form.input type="number" label="Number of PDF pages" name="number_of_pages"/>
        <x-scholar.form.submit disabled="1">SUBMIT</x-scholar.form.submit>
    </form>

</x-scholar.layout>
