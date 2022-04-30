<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.event.index'),
                    'label' => 'Events',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]
        "
    />
    <form action="{{route('scholar.event.store')}}" method="POST">
        @csrf
        <x-scholar.form.input name="title" label="Event title"/>

        <x-scholar.form.ckeditor name="description" label="Event Description" help="Describe the event to lure the users in."></x-scholar.form.ckeditor>

        <x-scholar.form.select name="account" label="Host">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" name="start_date" label="From" help="Event should at least be {{nova_get_setting('event_day_away', 30)}} days away."/>

        <x-scholar.form.input type="date" name="end_date" label="To"/>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>

    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
