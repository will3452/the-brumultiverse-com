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
                    'href' => route('scholar.book.create'),
                    'label' => 'Create',
                ]
            ]
        "
    />
    @if (request()->has('book') && is_null($book))
        <div class="alert alert-warning">Ebook version not found!</div>
    @endif

    @if (request()->has('book') && ! is_null($book))
        <div class="alert alert-success">Auto-filled, please double check the form.</div>
    @endif

    <form action="{{route('scholar.audiobook.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (! request()->has('book'))
            <div x-data="{
                hasEbook:0,
                autoFill:0,
                bookTitle:'',
            }">
                <x-scholar.form.select model="hasEbook" label="Does this Audio Book have a published ebook version on the app?">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-scholar.form.select>

                <template x-if="hasEbook == 1">
                    <div>
                        <x-scholar.form.select model="autoFill" label="Would you like to auto-fill the information?">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-scholar.form.select>

                        <template x-if="autoFill == 1 && hasEbook == 1">
                            <div>
                                <x-scholar.form.input model="bookTitle" name="book" label="Title of the ebook version?"/>
                                <a x-bind:href="`{{url()->current()}}?book=${bookTitle}`" class="btn btn-primary btn-sm">Auto-fill now</a>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        @endif

        <x-scholar.form.input label="Audio Book Title" name="title" value="{{is_null($book)?'':$book->title }}"/>

        <x-scholar.form.select name="category" label="Category">
            @foreach ($categories as $id=>$label)
                <option value="{{$id}}" {{(is_null($book) && optional(optional($book)->category)->name != $label) ?'':'selected'}}>{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.file name="cover" label="Audio Book Cover"/>

        <x-scholar.form.select name="account" label="Pen Name">
            @foreach ($accounts as $id=>$label)
                <option value="{{$id}}" {{optional($book)->account_id != $id ?:'selected'}}>{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <div x-data="{
            genreId:0,
            init() {
                this.genreId = document.querySelector('select[name=genre]').value;
            }
        }">
            <x-scholar.form.select model="genreId" name="genre" label="Genre">
                @foreach ($genres as $id=>$label)
                    <option value="{{$id}}" {{optional(optional($book)->genre)->name != $label ?'':'selected'}}>{{$label}}</option>
                @endforeach
            </x-scholar.form.select>

            <x-scholar.form.select name="heat_level" label="Heat Level" required="0">
                @foreach ($heatLevel as $l)
                    <template x-if="{{$l->genre_id}} == genreId">
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    </template>
                @endforeach
            </x-scholar.form.select>

            <x-scholar.form.select name="violence_level" label="Violence Level" required="0">
                @foreach ($violenceLevel as $l)
                    <template x-if="{{$l->genre_id}} == genreId">
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    </template>
                @endforeach
            </x-scholar.form.select>
        </div>

        <x-scholar.form.checkbox name="has_warning_message" label="Please add a content warning to my book."/>

        <x-scholar.form.tags name="tags" label="Tags" :value="is_null($book) ?'':\App\Helpers\TagHelper::toShow($book)"/>

        <x-scholar.form.select name="language" label="Language">
            @foreach ($languages as $id=>$label)
                <option value="{{$id}}" {{optional($book)->language_id != $id ?:'selected'}}>{{$label}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.select name="lead_character" label="Lead Character">
            <option value="{{\App\Models\User::GENDER_MALE}}" {{optional($book)->lead_character != \App\Models\User::GENDER_MALE ?:'selected'}}>{{\App\Models\User::GENDER_MALE}}</option>
            <option value="{{\App\Models\User::GENDER_FEMALE}}" {{optional($book)->lead_character != \App\Models\User::GENDER_MALE ?:'selected'}}>{{\App\Models\User::GENDER_FEMALE}}</option>
            <option value="{{\App\Models\User::GENDER_LGBT}}" {{optional($book)->lead_character != \App\Models\User::GENDER_MALE ?:'selected'}}>{{\App\Models\User::GENDER_LGBT}}</option>
        </x-scholar.form.select>

        <x-scholar.form.select name="lead_college" label="Lead's College">
            @foreach ($colleges as $name)
                <option value="{{$name}}" {{optional($book)->lead_college != $name ?:'selected'}}>{{$name}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.ckeditor name="blurb" label="Blurb">{{is_null($book)?'':$book->blurb}}</x-scholar.form.ckeditor>

        <x-scholar.form.number name="cost" label="Cost" :value="is_null($book)?0:$book->cost" help="Please note that leaving the cost to ZERO will allow the users to download it for FREE. Please indicate price in CRYSTALS."/>

        <x-scholar.form.ckeditor name="credit" label="Credit Page">{{is_null($book)?'':$book->credit}}</x-scholar.form.ckeditor>

        <x-scholar.form.filepond accept="audio" name="file" label="File" enable="button[type=submit]"/>

        <x-scholar.form.submit disabled="1">
            Submit
        </x-scholar.form.submit>
    </form>
    @push('head-script')
        <x-vendor.ckeditor/>
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
