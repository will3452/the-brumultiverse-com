<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.album.index'),
                    'label' => 'Albums',
                ],
                [
                    'href' => route('scholars.book.create'),
                    'label' => 'Create',
                ]
            ]
        "
    />
    <form action="{{route('scholars.album.store')}}" method="POST">
        @csrf
        <x-scholar.form.input name="title" label="Title"/>

        <x-scholar.form.select name="account_id" label="Account">
            @foreach ($accounts as $a)
                <option value="{{$a->id}}">{{$a->penname}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select name="type" label="Type">
            @foreach (\App\Models\Album::TYPES as $t)
                <option value="{{$t}}">{{$t}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.ckeditor name="description" label="Description"></x-scholar.form.ckeditor>

        <x-scholar.form.ckeditor name="credit" label="Credits"></x-scholar.form.ckeditor>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
</x-scholar.layout>
