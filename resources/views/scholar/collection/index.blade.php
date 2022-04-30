<x-scholar.layout>
    <x-scholar.page.title>Collections</x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Collections',
                ]
            ]
        "
    />
    <x-scholar.page.index creation-link="{{route('scholars.collection.create')}}" title="Collection" :model="$collections" >
        <x-scholar.table>
            <thead>
                <tr>
                    <th>
                        Date Created
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Type
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collections as $collection)
                    <tr>
                        <td>
                            {{$collection->created_at->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$collection->title}}
                        </td>
                        <td>
                            {{$collection->type}}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-scholar" href="{{route('scholars.collection.show', ['collection' => $collection->id])}}">show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
