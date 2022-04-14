<x-scholar.layout>
    <x-scholar.page.title>Series</x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Series',
                ]
            ]
        "
    />
    <x-scholar.page.index creation-link="{{route('scholar.series.create')}}" title="Collection" :model="$series" >
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
                @foreach ($series as $s)
                    <tr>
                        <td>
                            {{$s->created_at->format('m/d/Y')}}
                        </td>
                        <td>
                            {{$s->title}}
                        </td>
                        <td>
                            {{$s->type}}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-scholar" href="{{route('scholar.series.show', ['series' => $s->id])}}">show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
