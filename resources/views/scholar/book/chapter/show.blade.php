<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.book.index'),
                    'label' => 'Books',
                ],
                [
                    'href' => route('scholar.book.show', ['book' => $chapter->model_id]),
                    'label' => $chapter->model->title,
                ],
                [
                    'href' => route('scholar.book.chapters', ['book' => $chapter->model_id]),
                    'label' => 'Chapters',
                ],
                [
                    'href' => '#',
                    'label' => $chapter->title,
                ],
            ]
        "
    />
    <div class="flex md:flex-wrap flex-wrap-reverse">
        <div class="w-full md:w-8/12">
            <form action="{{route('scholar.chapter.update', ['chapter' => $chapter->id])}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-scholar.form.input name="title" label="Title" value="{{$chapter->title}}" />
                <x-scholar.form.number
                :value="$chapter->number"
                name="number"
                label="Chapter No." />
                @if ($chapter->model->category->file_type === \App\Models\Category::FILE_TYPE_TEXT)
                    <x-scholar.form.ckeditor label="Content" name="content">{{$chapter->content}}</x-scholar.form.ckeditor>
                @endif

                @if ($chapter->model->category->file_type === \App\Models\Category::FILE_TYPE_PDF)
                    <a href="/storage/{{$chapter->content}}" class="btn btn-sm btn-primary" target="_blank">View content.</a>
                @endif

                <div x-data="{
                    type:'',
                    init() {
                        this.type = `{{$chapter->type}}`
                    }
                }">
                    <x-scholar.form.select label="Type" name="type" model="type">
                        @foreach (\App\Models\Chapter::TYPE_OPTIONS as $o)
                            <option value="{{$o}}">{{$o}}</option>
                        @endforeach
                    </x-scholar.form.select>
                    <template x-if="(type == `{{\App\Models\Chapter::TYPE_PREMIUM}}` || type == `{{\App\Models\Chapter::TYPE_PREMIUM_WITH_FREE_ART_SCENE}}`)">
                        <div>
                            <x-scholar.form.ckeditor name="description" label="Description" help="This description will appear with the prompt, confirming whether reader wishes to proceed to the Premium Chapter for a fee. Make it as enticing as possible to lure them in.">{{$chapter->description}}</x-scholar.form.ckeditor>
                            <x-scholar.form.select name="age_restriction" label="Set Age Restriction">
                                <option value="0" {{$chapter->age_restriction == 0 ? 'selected':''}}>None</option>
                                <option value="16" {{$chapter->age_restriction == 16 ? 'selected':''}}>16 and up</option>
                                <option value="18" {{$chapter->age_restriction == 18 ? 'selected':''}}>18 and up</option>
                            </x-scholar.form.select>
                        </div>
                    </template>
                </div>
                <x-scholar.form.ckeditor name="notes" label="Author's Note">{{$chapter->notes}}</x-scholar.form.ckeditor>
                <x-scholar.form.number name="cost" label="Chapter Cost" :value="$chapter->cost" />
                <x-scholar.form.submit>
                    Update
                </x-scholar.form.submit>
            </form>
        </div>
        <div class="w-full md:w-4/12 p-4">
            @if ($chapter->isPremium() && $chapter->hasArtScene())
                <div>
                    <div class="mb-2">
                        <x-scholar.material-title icon="/img/icons/dashboard/image.svg" title="Free Art Scene"/>
                    </div>
                    <x-scholar.work-card href="{{route('scholar.artscene.show', ['art' => $chapter->freeArtScene()->id])}}" cover="{{optional($chapter->freeArtScene()->artFile)->getSize()}}">
                        {{$chapter->freeArtScene()->title}}
                    </x-scholar.work-card>
                </div>
            @endif
        </div>
    </div>

    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
