<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.film.index'),
                    'label' => 'Films',
                ],
                [
                    'href' => '#',
                    'label' => $film->title,
                ]
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">

            <x-scholar.page.update :editable="! $film->hasPublishedDate()" :update-link="route('scholar.film.update', ['film' => $film->id])">

                <x-scholar.form.input label="Title" name="title" value="{{$film->title}}"/>

                <div x-data="{
                    type:`{{$film->type}}`,
                }">
                    <x-scholar.form.select readonly model="type" name="type" label="Type">
                        @foreach (\App\Models\Film::TYPE_OPTIONS as $t)
                            <option value="{{$t}}">{{$t}}</option>
                        @endforeach
                    </x-scholar.form.select>

                    <template x-if="type != `{{\App\Models\Film::TYPE_TRAILER}}`">
                        <div>
                            <x-scholar.form.select  readonly name="genre" label="Genre">
                                @foreach ($genres as $id=>$label)
                                    <option {{$film->genre_id == $id ? 'selected':''}} value="{{$id}}">{{$label}}</option>
                                @endforeach
                            </x-scholar.form.select>
                        </div>
                    </template>
                </div>


                <x-scholar.form.select :readonly="true" name="account" label="Pen Name">
                    @foreach ($accounts as $id=>$label)
                        <option value="{{$id}}" {{$film->account_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.tags name="tags" label="Tags" :value="\App\Helpers\TagHelper::toShow($film)"/>

                <x-scholar.form.select readonly="true" name="language" label="Language">
                    @foreach ($languages as $id=>$label)
                        <option value="{{$id}}" {{$film->language_id === $id ? 'selected':''}}>{{$label}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.ckeditor name="description" label="Description">{{$film->description}}</x-scholar.form.ckeditor>


                <x-scholar.form.select readonly name="cost_type" label="Cystal">
                    @foreach (\App\Helpers\CrystalHelper::TYPE_OPTION_CRYSTALS as $c)
                        <option {{$film->cost_type == $c ? "":"selected"}} value="{{$c}}">{{$c}}</option>
                    @endforeach
                </x-scholar.form.select>

                <x-scholar.form.number readonly name="cost" value="{{$film->cost}}" label="Cost"/>

                <x-scholar.form.ckeditor name="credit" label="Credit Page">{{$film->credit}}</x-scholar.form.ckeditor>
            </x-scholar.page.update>
        </div>
        <div class="w-full md:w-4/12 p-4">
            <div class="flex justify-center">
                <img src="{{$film->cover->withWatermark()}}" alt="Shoes" class="block w-full max-w-xs rounded shadow-md">
            </div>

            <div class="my-4">
                <video src="/storage/{{$film->largeFile->path}}" controls></video>
            </div>

            <div class="flex justify-center mt-4 flex-wrap items-center">
                <x-scholar.request-publish-form :model="$film"/>
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
