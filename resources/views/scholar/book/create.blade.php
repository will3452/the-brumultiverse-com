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

    <form action="{{route('scholar.book.store')}}" method="POST" enctype="multipart/form-data" x-data="{type:`{{\App\Models\Book::TYPE_REGULAR}}`}">
        @csrf
        <x-scholar.form.select model="type" name="type" label="Please select what type of book you want to create.">
            <option value="{{\App\Models\Book::TYPE_REGULAR}}">{{\App\Models\Book::TYPE_REGULAR}}</option>
            <option value="{{\App\Models\Book::TYPE_PREMIUM}}">{{\App\Models\Book::TYPE_PREMIUM}}</option>
            <option value="{{\App\Models\Book::TYPE_SPIN}}">{{\App\Models\Book::TYPE_SPIN}}</option>
            {{-- <option value="{{\App\Models\Book::TYPE_EVENT}}">{{\App\Models\Book::TYPE_EVENT}}</option> --}}
            <option value="{{\App\Models\Book::TYPE_PLATINUM}}">{{\App\Models\Book::TYPE_PLATINUM}}</option>
        </x-scholar.form.select>

        <x-scholar.form.input label="Book Title" name="title"/>

        <x-scholar.form.select name="category" label="Category">
            @foreach ($categories as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.file name="cover" label="Book Cover"/>

        <x-scholar.form.select name="account" label="Pen Name">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <div x-data="{
            genreId:0,
            init() {
                this.genreId = document.querySelector('select[name=genre]').value;
            }
        }">
            <x-scholar.form.select model="genreId" name="genre" label="Genre">
                @foreach ($genres as $id=>$label)
                    <option value="{{$id}}">{{$label}}</option>
                @endforeach
            </x-scholar.form.select>

            <x-scholar.form.select name="heat_level" label="Heat Level" required="0">
                @foreach ($heatLevel as $l)
                    <template x-if="{{$l->genre_id}} == genreId">
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    </template>
                @endforeach
            </x-scholar.form.select>

            <x-scholar.form.select name="violence_level" label="Violence Level" required="0">
                @foreach ($violenceLevel as $l)
                    <template x-if="{{$l->genre_id}} == genreId">
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    </template>
                @endforeach
            </x-scholar.form.select>
        </div>

        <x-scholar.form.checkbox required="0" name="has_warning_message" label="Please add a content warning to my book."/>

        <x-scholar.form.tags name="tags" label="Tags"/>

        <x-scholar.form.select name="language" label="Language">
            @foreach ($languages as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select name="lead_character" label="Lead Character">
            <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
            <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
            <option value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
        </x-scholar.form.select>

        <x-scholar.form.select name="lead_college" label="Lead's College">
            @foreach ($colleges as $name)
                <option value="{{$name}}">{{$name}}</option>
            @endforeach
            <option value="NON-BRU">NON-BRU</option>
        </x-scholar.form.select>

        <x-scholar.form.ckeditor name="blurb" label="Blurb"/>

        <template x-if="`{{\App\Models\Book::TYPE_REGULAR}}` != type && `{{\App\Models\Book::TYPE_PLATINUM}}` != type">
            <x-scholar.form.number name="cost" label="Cost" help="Please note that leaving the cost to ZERO will allow the readers for FREE so long as they have hall passes. Please indicate price in purple crystals."/>
        </template>

        <template x-if="`{{\App\Models\Book::TYPE_PLATINUM}}` == type">
            <x-scholar.form.number name="cost" label="Cost" help="Platinum books will only be available to users upon purchase. Please indicate price per crystal."/>
        </template>

        <template x-if="`{{\App\Models\Book::TYPE_REGULAR}}` == type">
            <input type="hidden" name="cost" value="0">
        </template>

        <x-scholar.form.ckeditor name="credit" label="Credit Page"/>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
