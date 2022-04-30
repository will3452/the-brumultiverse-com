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
                    'href' => route('scholar.book.show', ['book' => $book->id]),
                    'label' => $book->title,
                ],
                [
                    'href' => '#',
                    'label' => 'Chapters',
                ]
            ]
        "
    />
    <div class="flex justify-between items-center">
        <x-scholar.page.title>
            Chapters
        </x-scholar.page.title>
        <div class="flex items-center">
            @if (! $book->prologue()->exists())
                <x-scholar.modal button="add prologue">
                    <form action="{{route('scholar.book.prologue', ['book' => $book])}}" method="POST">
                        @csrf
                        <x-scholar.form.ckeditor name="body" label="Prologue Content"></x-scholar.form.ckeditor>
                        <x-scholar.form.submit>
                            Submit
                        </x-scholar.form.submit>
                    </form>
                </x-scholar.modal>
            @endif
            @if (! $book->epilogue()->exists())
                <x-scholar.modal button="add epilogue">
                    <form action="{{route('scholar.book.epilogue', ['book' => $book])}}" method="POST">
                        @csrf
                        <x-scholar.form.ckeditor name="body" label="Epilogue Content"></x-scholar.form.ckeditor>
                        <x-scholar.form.submit>
                            Submit
                        </x-scholar.form.submit>
                    </form>
                </x-scholar.modal>
            @endif
        </div>
    </div>
    <x-scholar.page.index :model="$book->chapters" title="Chapters" creation-link="{{route('scholar.chapter.create', ['book' => $book->id])}}">
        <div class="mt-4">
            <x-scholar.table>
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Date Uploaded
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($book->prologue()->exists())
                        <tr>
                            <td>

                            </td>
                            <td>
                                Prologue
                            </td>
                            <td>

                            </td>
                            <td>
                                {{$book->prologue->created_at->format('m/d/y')}}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-scholar" href="{{route('scholar.prologue.show', ['prologue' => $book->prologue])}}">View</a>
                            </td>
                        </tr>
                    @endif
                    @foreach ($book->chapters as $c)
                        <tr>
                            <td>
                                {{$c->number}}
                            </td>
                            <td>
                                {{$c->title}}
                            </td>
                            <td>
                                {{$c->type}}
                            </td>
                            <td>
                                {{$c->created_at->format('m/d/y')}}
                            </td>
                            <td class="flex items-center">
                                <div class="tooltip tooltip-left tooltip-warning" data-tip="Add Free Art Scene" >
                                    @if ($c->isPremium() && ! $c->hasArtScene())
                                        <x-scholar.modal :id="'add-art-scene' . $c->id" no-button="1">
                                            <x-slot name="trigger">
                                                <label for="add-art-scene{{$c->id}}" class="btn btn-warning btn-xs mb-4 mr-2 ">
                                                    <img src="/img/icons/crud/plus.svg" alt="" class="w-4 h-4">
                                                    <img src="/img/icons/dashboard/image.svg" alt="" class="w-4 h-4">
                                                </label>
                                            </x-slot>
                                            <form action="{{route('scholar.free.art-scene')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="Chapter">
                                                <input type="hidden" name="id" value="{{$c->id}}">
                                                <x-scholar.form.select name="art_scene_id" label="Select Art Scene">
                                                    @foreach ($artScenes as $a)
                                                        <option value="{{$a->id}}">
                                                            {{$a->title}}
                                                        </option>
                                                    @endforeach
                                                </x-scholar.form.select>
                                                <x-scholar.form.submit>
                                                    Submit
                                                </x-scholar.form.submit>
                                            </form>
                                        </x-scholar.modal>
                                    @endif
                                </div>
                                <div>
                                    <a class="btn btn-xs btn-scholar" href="{{route('scholar.chapter.show', ['chapter' => $c->id])}}">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if ($book->epilogue()->exists())
                        <tr>
                            <td>

                            </td>
                            <td>
                                Epilgoue
                            </td>
                            <td>

                            </td>
                            <td>
                                {{$book->epilogue->created_at->format('m/d/y')}}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-scholar" href="{{route('scholar.epilogue.show', ['epilogue' => $book->epilogue])}}">View</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </x-scholar.table>
        </div>
    </x-scholar.page.index>

    @push('head-script')
        <x-vendor.ckeditor/>
    @endpush
</x-scholar.layout>
