<x-scholar.layout>
    <x-scholar.page.title>Albums</x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Albums',
                ]
            ]
        "
    />
    <x-scholar.page.index creation-link="{{route('scholars.album.create')}}" title="Album" :model="$albums" >
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
                @foreach ($albums as $album)
                    <tr>
                        <td>
                            {{$album->created_at->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$album->title}}
                        </td>
                        <td>
                            {{$album->type}}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-scholar" href="{{route('scholars.album.show', ['album' => $album->id])}}">show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
