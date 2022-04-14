<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.collection.index'),
                    'label' => 'Collections',
                ],
                [
                    'href' => route('scholar.book.create'),
                    'label' => 'Create',
                ]
            ]
        "
    />
    <form action="{{route('scholar.collection.store')}}" method="POST">
        @csrf
        <x-scholar.form.input name="title" label="Title"/>

        <x-scholar.form.select name="account_id" label="Account">
            @foreach ($accounts as $a)
                <option value="{{$a->id}}">{{$a->penname}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select name="type" label="Type">
            @foreach (\App\Models\Collection::TYPES as $t)
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
