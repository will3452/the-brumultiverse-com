<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.audiobook.index'),
                    'label' => 'Audio Books',
                ],
                [
                    'href' => '#',
                    'label' => $audio->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">

            <x-scholar.page.update :editable="! $audio->hasPublishedDate()" :update-link="route('scholar.audiobook.update', ['audio' => $audio->id])">

                <x-scholar.form.input label="Book Title" name="title" :value="$audio->title"/>

                <x-scholar.form.select :readonly="true" name="category" label="Category">
                    @foreach ($categories as $id=>$label)
                        <option value="{{$id}}" {{$audio->category_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                {{-- <x-scholar.form.file name="cover" label="Book Cover"/> --}}

                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$audio->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select :readonly="true" name="genre" label="Genre">
                    @foreach ($genres as $id=>$label)
                        <option value="{{$id}}" {{$audio->genre_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.checkbox checked="{{! is_null($audio->has_warning_message)}}" name="has_warning_message" label="Please add a content warning to my book."/>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($audio)"/>

                <x-scholar.form.select readonly="true" name="language" label="Language">
                    @foreach ($languages as $id=>$label)
                        <option value="{{$id}}" {{$audio->language_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select readonly="true" name="lead_character" label="Lead Character">
                    <option {{$audio->lead_character === \App\Models\User::GENDER_MALE ? 'selected':''}} value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                    <option {{$audio->lead_character === \App\Models\User::GENDER_FEMALE ? 'selected':''}} value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option {{$audio->lead_character === \App\Models\User::GENDER_LGBT ? 'selected':''}} value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                </x-scholar.form.select>

                <x-scholar.form.select readonly name="lead_college" label="Lead's College">
                    @foreach ($colleges as $name)
                        <option value="{{$name}}" {{$audio->lead_college === $name ? 'selected':''}}>{{$name}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.ckeditor name="blurb" label="Blurb">
                    {{$audio->blurb}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.number readonly="true" name="cost" value="{{$audio->cost}}" label="Cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

                <x-scholar.form.ckeditor name="credit" label="Credit Page">
                    {{$audio->credit}}
                </x-scholar.form.ckeditor>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$audio->cover->withWatermark()}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>

            <x-scholar.audio-player src="/storage/{{$audio->largeFile->path}}"/>
            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.request-publish-form :model="$audio"/>

                {{-- <x-scholar.modal extra="btn-sm btn-warning" button="Send ticket">
                    Send Ticket
                </x-scholar.modal> --}}
            </div>
            <div class="flex justify-center">
                <x-scholar.ticket-form :model="$audio"/>
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
