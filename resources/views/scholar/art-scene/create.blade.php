<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.artscene.index'),
                    'label' => 'Art Scenes',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]
        "
    />

    <form action="{{route('scholars.artscene.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-scholar.form.input label="Art Scene Title" name="title"/>

        <x-scholar.form.select name="account" label="Pen Name">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select model="genreId" name="genre" label="Genre">
            @foreach ($genres as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select label="Age Restriction" name="age_restriction">
            <option value="0">None</option>
            <option value="15">15 and up</option>
            <option value="18">18 and up</option>
        </x-scholar.form.select>

        <x-scholar.form.tags name="tags" label="Tags"/>

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

        <x-scholar.form.ckeditor name="description" label="Description"/>

        <x-scholar.form.number name="cost" label="Cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

        <x-scholar.form.ckeditor name="credit" label="Credit Page"/>

        <x-scholar.form.filepond name="file" label="Upload Art Scene" accept="image" enable="button[type=submit]"/>

        <x-scholar.form.submit :disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
