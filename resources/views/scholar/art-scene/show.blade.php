<x-scholar.layout in-app="{{false}}">
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.artscene.index'),
                    'label' => 'Art Scenes',
                ],
                [
                    'href' => '#',
                    'label' => $artScene->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">
            <x-scholar.page.update :editable="! $artScene->hasPublishedDate()" :update-link="route('scholar.artscene.update', ['art' => $artScene->id])">
                <x-scholar.form.input label="Art Scene Title" name="title" :value="$artScene->title"/>

                {{-- <x-scholar.form.file name="cover" label="Book Cover"/> --}}

                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$artScene->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select :readonly="true" name="genre" label="Genre">
                    @foreach ($genres as $id=>$label)
                        <option value="{{$id}}" {{$artScene->genre_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($artScene)"/>

                <x-scholar.form.select readonly="true" name="lead_character" label="Lead Character">
                    <option {{$artScene->lead_character === \App\Models\User::GENDER_MALE ? 'selected':''}} value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                    <option {{$artScene->lead_character === \App\Models\User::GENDER_FEMALE ? 'selected':''}} value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option {{$artScene->lead_character === \App\Models\User::GENDER_LGBT ? 'selected':''}} value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                </x-scholar.form.select>

                <x-scholar.form.select readonly name="lead_college" label="Lead's College">
                    @foreach ($colleges as $name)
                        <option value="{{$name}}" {{$artScene->lead_college === $name ? 'selected':''}}>{{$name}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.ckeditor name="description" label="Description">
                    {{$artScene->description}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.number readonly="true" name="cost" value="{{$artScene->cost}}" label="Cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

                <x-scholar.form.ckeditor name="credit" label="Credit Page">
                    {{$artScene->credit}}
                </x-scholar.form.ckeditor>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$artScene->artFile->withFrame(null,false,true)}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>

            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.request-publish-form :model="$artScene"/>
                {{-- <x-scholar.modal extra="btn-sm btn-warning" button="Send ticket">
                    Send Ticket
                </x-scholar.modal> --}}
            </div>
            <div class="flex justify-center">
                <x-scholar.ticket-form :model="$artScene"/>
            </div>
        </div>
    </div>
    @push('head-script')
        <x-vendor.ckeditor/>
        {{-- <x-vendor.alpinejs/> --}}
    @endpush
</x-scholar.layout>
