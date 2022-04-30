<x-scholar.layout>
    <x-scholar.page.title>
        Newspaper
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.newspaper.index'),
                    'label' => 'Newspapers',
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
    action="{{route('scholars.newspaper.store')}}"
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

        <x-scholar.form.input name="headline" label="Headline" />

        <x-scholar.form.ckeditor name="content" label="New Feature Content"></x-scholar.form.ckeditor>

        <x-scholar.form.file name="file" label="Upload image"/>
        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>

    @push('head-script')
        <x-vendor.ckeditor/>
    @endpush
</x-scholar.layout>
