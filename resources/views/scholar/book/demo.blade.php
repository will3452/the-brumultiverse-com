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
                'label' => 'preview',
            ]
        ]
    "
/>

{{$chapter->links()}}
    <div class="flex">
    @foreach ($chapter as $c)
        <div class="mockup-phone">
            <div class="camera"></div>
            <div class="display">
                <div class="artboard bg-white phone-1 pt-8 p-10 font-serif overflow-y-auto">
                    <h1 class="text-center text-lg font-bold ">{{$c->title}}</h1>
                    @if ($fileType === \App\Models\Category::FILE_TYPE_TEXT)
                        <div class="text-justify text-sm">
                            {!!$c->content!!}
                        </div>
                    @endif

                    @if ($fileType === \App\Models\Category::FILE_TYPE_PDF)
                    <object data="/storage/{{$c->content}}" class="w-full h-full border"></object>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>
    {{$chapter->links()}}
</x-scholar.layout>
