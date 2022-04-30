<x-scholar.layout>
    <x-scholar.page.title>
        Marquee
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.marquee.index'),
                    'label' => 'Marquees',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]
        "
    />
    <form
    enctype="multipart/form-data"
    action="{{route('scholars.marquee.store')}}"
    method="POST">
        @csrf
        <x-scholar.form.select name="package_id" label="Duration">
            @foreach ($packages as $p)
                <option value="{{$p->id}}">
                    {{$p->name}}
                </option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input type="date" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />

        <x-scholar.form.ckeditor name="content" label="Content" help="up to 100 characters only"></x-scholar.form.ckeditor>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
</x-scholar.layout>
