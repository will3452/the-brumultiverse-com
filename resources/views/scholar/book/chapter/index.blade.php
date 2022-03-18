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

    <x-scholar.page.index title="Chapters" creation-link="{{route('scholar.chapter.create', ['book' => $book->id])}}">
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
                            <td>
                                <a class="btn btn-sm" href="{{route('scholar.chapter.show', ['chapter' => $c->id])}}">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-scholar.table>
        </div>
    </x-scholar.page.index>
</x-scholar.layout>
