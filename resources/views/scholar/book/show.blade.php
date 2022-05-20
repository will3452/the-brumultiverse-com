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
                    'href' => '#',
                    'label' => $book->title,
                ]
            ]
        "
    />
    @if (is_null($book->front_matter))
        <x-scholar.alert proceed-text="upload now" href="{{route('scholar.book.pdf', ['book' => $book->id])}}">
            Please click "Upload Now" to upload one .PDF file that contains your BOOK TITLE PAGE, COPYRIGHT PAGE, ACKNOWLEDGMENT PAGE AND DEDICATION PAGE. Thank you!
        </x-scholar.alert>
    @endif
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">
            <form action="{{}}" method="POST" >
                @method('PUT')
                @csrf

            </form>
            <x-scholar.page.update :editable="! $book->hasPublishedDate()" :update-link="route('scholar.book.update', ['book' => $book->id])">
                <x-scholar.form.select name="type" label="Book Type" readonly="true">
                    <option {{$book->type === \App\Models\Book::TYPE_REGULAR ? 'selected':''}} value="{{\App\Models\Book::TYPE_REGULAR}}">{{\App\Models\Book::TYPE_REGULAR}}</option>
                    <option {{$book->type === \App\Models\Book::TYPE_PREMIUM ? 'selected':''}} value="{{\App\Models\Book::TYPE_PREMIUM}}">{{\App\Models\Book::TYPE_PREMIUM}}</option>
                    <option {{$book->type === \App\Models\Book::TYPE_SPIN ? 'selected':''}} value="{{\App\Models\Book::TYPE_SPIN}}">{{\App\Models\Book::TYPE_SPIN}}</option>
                    <option {{$book->type === \App\Models\Book::TYPE_EVENT ? 'selected':''}} value="{{\App\Models\Book::TYPE_EVENT}}">{{\App\Models\Book::TYPE_EVENT}}</option>
                </x-scholar.form.select>

                <x-scholar.form.input label="Book Title" name="title" :value="$book->title"/>

                <x-scholar.form.select :readonly="true" name="category" label="Category" :value="$book->category_id">
                    @foreach ($categories as $id=>$label)
                        <option value="{{$id}}" {{$book->category_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                {{-- <x-scholar.form.file name="cover" label="Book Cover"/> --}}

                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$book->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select :readonly="true" name="genre" label="Genre">
                    @foreach ($genres as $id=>$label)
                        <option value="{{$id}}" {{$book->genre_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.checkbox checked="{{! is_null($book->has_warning_message)}}" name="has_warning_message" label="Please add a content warning to my book."/>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($book)"/>

                <x-scholar.form.select readonly="true" name="language" label="Language">
                    @foreach ($languages as $id=>$label)
                        <option value="{{$id}}" {{$book->language_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select readonly="true" name="lead_character" label="Lead Character">
                    <option {{$book->lead_character === \App\Models\User::GENDER_MALE ? 'selected':''}} value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                    <option {{$book->lead_character === \App\Models\User::GENDER_FEMALE ? 'selected':''}} value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option {{$book->lead_character === \App\Models\User::GENDER_LGBT ? 'selected':''}} value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                </x-scholar.form.select>

                <x-scholar.form.select readonly name="lead_college" label="Lead's College">
                    @foreach ($colleges as $name)
                        <option value="{{$name}}" {{$book->lead_college === $name ? 'selected':''}}>{{$name}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.ckeditor name="blurb" label="Blurb">
                    {{$book->blurb}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.number readonly="true" name="cost" value="{{$book->cost}}" label="Cost" />

                <x-scholar.form.ckeditor name="credit" label="Credit Page">
                    {{$book->credit}}
                </x-scholar.form.ckeditor>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$book->cover->withFrame()}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>
            <div class="flex justify-center">
                <x-scholar.ticket-form :model="$book" />
            </div>
            <div class="flex justify-center items-center">
                <x-scholar.request-publish-form :model="$book"/>
            </div>
            <div class="flex justify-center flex-wrap items-center">
                <a href="{{route('scholar.book.chapters', ['book' => $book->id])}}" class="btn btn-scholar btn-sm m-2">View all chapters.</a>
                {{-- <x-scholar.modal extra="btn-sm btn-warning" button="Send ticket">
                    Send Ticket
                </x-scholar.modal> --}}
            </div>
            {{-- <div class="flex justify-center">
                <a class="btn btn-sm btn-scholar" href="javascript:alert('under maintenance')">View Demo</a>
            </div> --}}
        </div>
    </div>
    @push('head-script')
        <x-vendor.ckeditor/>
    @endpush
</x-scholar.layout>
