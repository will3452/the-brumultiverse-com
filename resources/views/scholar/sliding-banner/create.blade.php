<x-scholar.layout>
    <x-scholar.page.title>
        Sliding Banner
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.sliding-banner.index'),
                    'label' => 'Sliding Banners',
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
    action="{{route('scholar.sliding-banner.store')}}"
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

        <x-scholar.form.file name="file" label="Upload Image Banner" help="Create your own banner? click <a href='{{route('scholar.banner.editor')}}' class='underline'>here</a>"/>

        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>
</x-scholar.layout>
