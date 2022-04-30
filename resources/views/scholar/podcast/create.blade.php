<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.podcast.index'),
                    'label' => 'Podcasts',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]"
    />

    <form action="{{route('scholars.podcast.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-scholar.form.input label="Title" name="title"/>

        <x-scholar.form.file name="cover" label="Cover"/>

        <x-scholar.form.select name="account" label="Host">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}">{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select name="episode_type" label="Episode Type">
            <option value="{{\App\Models\Podcast::EPISODE_TYPE_SERIES}}">{{\App\Models\Podcast::EPISODE_TYPE_SERIES}}</option>
            <option value="{{\App\Models\Podcast::EPISODE_TYPE_SOLO}}">{{\App\Models\Podcast::EPISODE_TYPE_SOLO}}</option>
        </x-scholar.form.select>

        <x-scholar.form.tags name="tags" label="Tags"/>

        <x-scholar.form.ckeditor name="description" label="Description"/>

        <div x-data="{
            type:`{{\App\Models\Podcast::TYPE_REGULAR}}`,
        }">
            <x-scholar.form.select model="type" name="type" label="Type">
                <option value="{{\App\Models\Podcast::TYPE_REGULAR}}">{{\App\Models\Podcast::TYPE_REGULAR}}</option>
                <option value="{{\App\Models\Podcast::TYPE_PREMIUM}}">{{\App\Models\Podcast::TYPE_PREMIUM}}</option>
            </x-scholar.form.select>
            <input type="hidden" name="cost_type" x-bind:value="type == `{{\App\Models\Podcast::TYPE_REGULAR}}` ? `{{\App\Helpers\CrystalHelper::HALL_PASS}}` : `{{\App\Helpers\CrystalHelper::PURPLE_CRYSTAL}}`">
            <template x-if="type == `{{\App\Models\Podcast::TYPE_REGULAR}}`">
                <div>
                    <x-scholar.form.number name="cost" label="Cost" help="Please select number of Hall Pass required to listen."/>
                </div>
            </template>

            <template x-if="type != `{{\App\Models\Podcast::TYPE_REGULAR}}`">
                <div>
                    <x-scholar.form.number name="cost" label="Cost" help="Please select number of Purple Crystal required to listen."/>
                </div>
            </template>
        </div>

        <x-scholar.form.filepond label="Upload" name="file" enable="button[type=submit]" accept="audio"/>

        <x-scholar.form.ckeditor name="credit" label="Credits"/>

        <x-scholar.form.input label="Launch Date" name="launch_at" help="Format mm/dd/yyyy"/>

        <x-scholar.form.submit :disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
