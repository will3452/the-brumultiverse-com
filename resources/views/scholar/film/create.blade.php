<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="[
                    [
                        'href' => route('scholar.home'),
                        'label' => 'Home',
                    ],
                    [
                        'href' => route('scholars.film.index'),
                        'label' => 'Film',
                    ],
                    [
                        'href' => '#',
                        'label' => 'Create',
                    ]
            ]"
    />

    <form action="{{route('scholars.film.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-scholar.form.input label="Title" name="title" />

        <div x-data="{
            type:`{{\App\Models\Film::TYPE_TRAILER}}`,
        }">
            <x-scholar.form.select model="type" name="type" label="Type">
                @foreach (\App\Models\Film::TYPE_OPTIONS as $t)
                    <option value="{{$t}}">{{$t}}</option>
                @endforeach
            </x-scholar.form.select>

            <template x-if="type != `{{\App\Models\Film::TYPE_TRAILER}}`">
                <div>
                    <x-scholar.form.select  name="genre" label="Genre">
                        @foreach ($genres as $id=>$label)
                            <option value="{{$id}}">{{$label}}</option>
                        @endforeach
                    </x-scholar.form.select>
                </div>
            </template>
        </div>


        <x-scholar.form.select label="Age Restriction" name="age_restriction">
            <option value="0">None</option>
            <option value="15">15 and up</option>
            <option value="18">18 and up</option>
        </x-scholar.form.select>

        <x-scholar.form.file name="cover" label="Cover"/>

        <x-scholar.form.select name="account" label="Pen Name">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.tags name="tags" label="Tags"/>

        <x-scholar.form.select name="language" label="Language">
            @foreach ($languages as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.ckeditor name="description" label="Description"></x-scholar.form.ckeditor>


        <template x-if="type === `{{\App\Models\Film::TYPE_TRAILER}}`">
            <x-scholar.form.select name="cost_type" label="Cystal">
                @foreach (\App\Helpers\CrystalHelper::TYPE_OPTION_CRYSTALS as $c)
                    <option value="{{$c}}">{{$c}}</option>
                @endforeach
            </x-scholar.form.select>
        </template>

        <template x-if="type != `{{\App\Models\Film::TYPE_TRAILER}}`">
            <div>
                <input type="hidden" name="cost_type" value="{{\App\Helpers\CrystalHelper::PURPLE_CRYSTAL}}" />
            </div>
        </template>

        <x-scholar.form.number name="cost" label="Cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

        <x-scholar.form.ckeditor name="credit" label="Credit Page"></x-scholar.form.ckeditor>

        <x-scholar.form.filepond accept="video" name="file" label="File" enable="button[type=submit]"/>

        <x-scholar.form.submit disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
