<x-scholar.layout>
    <x-scholar.page.title>
        Content Setting
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
                ],
                [
                    'href' => '#',
                    'label' => 'Content Setting',
                ]
            ]
        "
    />
    <iframe src="{{route('scholar.book-content.preview', ['book' => $book])}}" frameborder="0" class="w-full mb-4 border-2" style="height:70vh"></iframe>
    <book-content-setting book-type="{{$book->type}}" last-chapter-id="{{$book->last_chapter_id}}" book-id="{{$book->id}}" book-content-id="{{$bookContentId}}" :types="[@foreach(\App\Models\BookContentChapter::TYPES as $type) `{{$type}}`, @endforeach]"></book-content-setting>
    </div>
</x-scholar.layout>
