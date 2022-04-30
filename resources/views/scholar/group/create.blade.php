<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="[
                    [
                        'href' => route('scholars.home'),
                        'label' => 'Home',
                    ],
                    [
                        'href' => route('scholars.group.index'),
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
    <form action="{{route('scholars.group.store')}}" method="POST">
        @csrf
        <x-scholar.form.select label="Account" name="account_id">
            @foreach ($accounts as $a)
                <option value="{{$a->id}}">
                    {{$a->penname}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input label="Group Name" name="name"/>

        <x-scholar.form.select label="Group Types" name="type">
            @foreach ($types as $type)
                <option value="{{$type->description}}">{{$type->description}}</option>
            @endforeach
        </x-scholar.form.select>

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
