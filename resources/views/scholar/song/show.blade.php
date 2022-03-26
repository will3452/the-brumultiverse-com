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
                    'label' => $song->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">
            <x-scholar.page.update :editable="! $song->hasPublishedDate()" :update-link="route('scholar.song.update', ['song' => $song->id])">

                <x-scholar.form.input label="Song Title" name="title" :value="$song->title"/>

                {{-- <x-scholar.form.file name="cover" label="Book Cover"/> --}}

                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$song->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select :readonly="true" name="genre" label="Genre">
                    @foreach ($genres as $id=>$label)
                        <option value="{{$id}}" {{$song->genre_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.checkbox checked="{{! is_null($song->has_warning_message)}}" name="has_warning_message" label="Please add a content warning to my book."/>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($song)"/>

                <x-scholar.form.select readonly="true" name="lead_character" label="Lead Character">
                    <option {{$song->lead_character === \App\Models\User::GENDER_MALE ? 'selected':''}} value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                    <option {{$song->lead_character === \App\Models\User::GENDER_FEMALE ? 'selected':''}} value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option {{$song->lead_character === \App\Models\User::GENDER_LGBT ? 'selected':''}} value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                </x-scholar.form.select>

                <x-scholar.form.ckeditor name="description" label="Description">
                    {{$song->description}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.ckeditor name="lyrics" label="Lyrics">
                    {{$song->lyrics}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.number readonly="true" name="cost" value="{{$song->cost}}" label="Cost" help="Please note that leaving the cost of your book in 0 will allow free access to readers, so long as they have hall passes or silver tickets. Please indicate price in CRYSTALS."/>

                <x-scholar.form.ckeditor name="credit" label="Credit Page">
                    {{$song->credit}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.ckeditor name="copyright" label="Copyright">
                    {{$song->copyright}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.checkbox checked="{{$song->not_yet_copyrighted}}" name="not_yet_copyrighted" label="This song is not yet copyrighted."/>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$song->cover->withWatermark()}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>

            <x-scholar.audio-player src="/storage/{{$song->largeFile->path}}"/>
            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.request-publish-form :model="$song"/>
                {{-- <x-scholar.modal extra="btn-sm btn-warning" button="Send ticket">
                    Send Ticket
                </x-scholar.modal> --}}
            </div>
        </div>
    </div>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
    @push('body-script')
        <x-vendor.howlerjs/>
    @endpush
</x-scholar.layout>
