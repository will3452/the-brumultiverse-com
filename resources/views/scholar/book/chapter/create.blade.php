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
                    'label' => 'Create New',
                ],
            ]
        "
    />
    <div>
        <form action="{{route('scholar.chapter.store', ['book' => $book->id])}}"
            x-data="{
                type:'',
                init() {
                    this.type = `{{\App\Models\Chapter::TYPE_REGULAR}}`
                }
            }"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <x-scholar.form.input name="title" label="Title" />
            <x-scholar.form.number
            :value="count($book->chapters) === 0 ? 1 : $book->chapters()->latest()->first()->number + 1"
            name="number"
            label="Chapter No."
            :help="count($book->chapters) === 0 ? 'This will be the 1st chapter of this book.' : 'Previous Chapter :' . $book->chapters()->latest()->first()->number" />
            @if ($fileType === \App\Models\Category::FILE_TYPE_TEXT)
                <x-scholar.form.ckeditor label="Content" name="content"/>
            @endif

            @if ($fileType === \App\Models\Category::FILE_TYPE_PDF)
                <x-scholar.form.file label="Content" name="content" help="maximum of 2mb"/>
            @endif

            @if ($book->type !== \App\Models\Book::TYPE_PLATINUM)
                <div>
                    <x-scholar.form.select label="Type" name="type" model="type">
                        @foreach (\App\Models\Chapter::TYPE_OPTIONS as $o)
                            @if (! ($o == \App\Models\Chapter::TYPE_PREMIUM && $book->type === \App\Models\Book::TYPE_SPIN))
                                <option value="{{$o}}">{{$o}}</option>
                            @endif
                        @endforeach
                    </x-scholar.form.select>
                    <template x-if="(type == `{{\App\Models\Chapter::TYPE_PREMIUM}}` || type == `{{\App\Models\Chapter::TYPE_PREMIUM_WITH_FREE_ART_SCENE}}`)">
                        <div>
                            <x-scholar.form.ckeditor name="description" label="Description" help="This description will appear with the prompt, confirming whether reader wishes to proceed to the Premium Chapter for 1 Purple Crystal. Make it as enticing as possible to lure them in."/>
                            <x-scholar.form.select name="age_restriction" label="Set Age Restriction">
                                <option value="0">None</option>
                                <option value="16">16 and up</option>
                                <option value="18">18 and up</option>
                            </x-scholar.form.select>
                        </div>
                    </template>
                </div>
                {{-- <x-scholar.form.number name="cost" label="Chapter Cost"/> --}}

                <template x-if="type === `{{\App\Models\Chapter::TYPE_REGULAR}}`">
                    <div>
                        <input type="hidden" name="cost" value="1">
                        <input type="hidden" name="cost_type" value="{{\App\Helpers\CrystalHelper::HALL_PASS}}">
                    </div>
                </template>

                <template x-if="type === `{{\App\Models\Chapter::TYPE_PREMIUM}}`">
                    <div>
                        <input type="hidden" name="cost" value="1">
                        <input type="hidden" name="cost_type" value="{{\App\Helpers\CrystalHelper::PURPLE_CRYSTAL}}">
                    </div>
                </template>

                <template x-if="type === `{{\App\Models\Chapter::TYPE_SPECIAL}}`">
                    <div>
                        <input type="hidden" name="cost" value="2">
                        <input type="hidden" name="cost_type" value="{{\App\Helpers\CrystalHelper::HALL_PASS}}">
                    </div>
                </template>
            @endif

            <x-scholar.form.ckeditor name="notes" label="Author's Note"/>
            <x-scholar.form.submit>
                Submit
            </x-scholar.form.submit>
        </form>
    </div>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
