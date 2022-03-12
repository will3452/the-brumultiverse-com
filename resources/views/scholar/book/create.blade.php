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
                    'href' => route('scholar.book.create'),
                    'label' => 'Create',
                ]
            ]
        "
    />

    <form action="">
        <x-scholar.form.input label="Book Title" name="title"/>
    </form>

</x-scholar.layout>
