<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.podcast.index'),
                    'label' => 'Podcasts',
                ],
                [
                    'href' => '#',
                    'label' => $podcast->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">

            <x-scholar.page.update :editable="! $podcast->hasPublishedDate()" :update-link="route('scholar.podcast.update', ['podcast' => $podcast->id])">

                <x-scholar.form.input label="Title" name="title" :value="$podcast->title"/>

                {{-- <x-scholar.form.file name="cover" label="Book Cover"/> --}}

                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$podcast->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.select readonly model="type" name="type" label="Episode Type">
                    <option {{$podcast->type === \App\Models\Podcast::TYPE_REGULAR ? 'selected':''}} value="{{\App\Models\Podcast::TYPE_REGULAR}}">{{\App\Models\Podcast::TYPE_REGULAR}}</option>
                    <option {{$podcast->type === \App\Models\Podcast::TYPE_PREMIUM ? 'selected':''}} value="{{\App\Models\Podcast::TYPE_PREMIUM}}">{{\App\Models\Podcast::TYPE_PREMIUM}}</option>
                </x-scholar.form.select>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($podcast)"/>


                <x-scholar.form.ckeditor name="description" label="Description">
                    {{$podcast->description}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.input readonly="true" value="{{$podcast->cost}} {{ $podcast->cost > 0  ? \Str::plural($podcast->cost_type): $podcast->cost_type}}" label="Crystal / Hall-pass"/>

                <x-scholar.form.ckeditor name="credit" label="Credit Page">
                    {{$podcast->credit}}
                </x-scholar.form.ckeditor>

                <x-scholar.form.input label="Launch Date" name="launch_at" value="{{$podcast->launch_at->format('m/d/y')}}" readonly/>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$podcast->cover->withWatermark()}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>

            <x-scholar.audio-player src="/storage/{{$podcast->largeFile->path}}"/>
            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.request-publish-form :model="$podcast"/>

            </div>
            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.ticket-form :model="$podcast"/>
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
