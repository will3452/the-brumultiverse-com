<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="[
                    [
                        'href' => route('scholar.home'),
                        'label' => 'Home',
                    ],
                    [
                        'href' => route('scholar.group.index'),
                        'label' => 'Groups',
                    ],
                    [
                        'href' => '#',
                        'label' => 'Create',
                    ]
            ]"
    />
    <x-scholar.alert no-ok="1">
        The group to be created will be reviewed and approved by the Administrator.
    </x-scholar.alert>
    <form action="{{route('scholar.group.store')}}" method="POST">
        @csrf
        <x-scholar.form.select label="Account" name="account_id">
            @foreach ($accounts as $a)
                <option value="{{$a->id}}">
                    {{$a->penname}}
                </option>
            @endforeach
        </x-scholar.form.select>

        @if (! request()->has('name'))
            <x-scholar.form.input label="Group Name" name="name"/>

        @else
            <input type="hidden" name="name" value="{{request()->name}}">
        @endif

        @if (! request()->has('book'))
            <x-scholar.form.select label="Group Types" name="type">
                @foreach ($types as $type)
                    <option value="{{$type->description}}">{{$type->description}}</option>
                @endforeach
            </x-scholar.form.select>
        @endif

        @if (request()->has('book'))
            <input type="hidden" name="type" value="Book" />
            <input type="hidden" name="book" value="{{request()->book}}" />
        @endif

        <x-scholar.form.ckeditor label="Description" name="description"></x-scholar.form.ckeditor>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
