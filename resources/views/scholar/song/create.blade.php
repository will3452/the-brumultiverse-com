<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.song.index'),
                    'label' => 'Songs',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]"
    />

    <form action="{{route('scholar.song.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-scholar.form.input label="Song Title" name="title"/>

        <x-scholar.form.file name="cover" label="Cover"/>

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

        <x-scholar.form.tags name="tags" label="Tags"/>

        <x-scholar.form.ckeditor name="description" label="Description"/>

        <x-scholar.form.number name="cost" label="Cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

        <x-scholar.form.filepond label="Upload song" name="file" enable="button[type=submit]" accept="audio"/>

        <x-scholar.form.ckeditor name="credit" label="Credits"/>

        <x-scholar.form.ckeditor name="lyrics" label="Lyrics"/>

        <x-scholar.form.ckeditor name="copyright" label="Copyright" :required="0"/>

        <x-scholar.form.checkbox name="not_yet_copyrighted" label="This song is not yet copyrighted."/>

        <x-scholar.form.submit :disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
