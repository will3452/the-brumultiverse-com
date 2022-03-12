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

    <form action="{{route('scholar.book.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-scholar.form.select name="type" label="Please select what type of book you want to create.">
            <option value="{{\App\Models\Book::TYPE_REGULAR}}">{{\App\Models\Book::TYPE_REGULAR}}</option>
            <option value="{{\App\Models\Book::TYPE_PREMIUM}}">{{\App\Models\Book::TYPE_PREMIUM}}</option>
            <option value="{{\App\Models\Book::TYPE_SPIN}}">{{\App\Models\Book::TYPE_SPIN}}</option>
            <option value="{{\App\Models\Book::TYPE_EVENT}}">{{\App\Models\Book::TYPE_EVENT}}</option>
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

        <x-scholar.form.select name="genre" label="Genre">
            @foreach ($genres as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.checkbox name="has_warning_message" label="Please add a content warning to my book."/>

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
        </x-scholar.form.select>

        <x-scholar.form.ckeditor name="blurb" label="Blurb"/>

        <x-scholar.form.number name="cost" label="Cost" help="Please note that leaving the cost of your book in 0 will allow free access to readers, so long as they have hall passes or silver tickets. Please indicate price in CRYSTALS."/>

        <x-scholar.form.ckeditor name="credit" label="Credit Page"/>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <script src='/vendor/ckeditor/ckeditor.js'></script>
    @endpush
</x-scholar.layout>
