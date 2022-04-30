<x-scholar.layout>
    <x-scholar.page.title>
        Newspaper
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Newspapers',
                ]
            ]
        "
    />
    <x-scholar.page.index
    data="bulletins"
    view="scholar.newspaper.index"
    :model="$newspapers"
    :creation-link="route('scholars.newspaper.create')"
    title="Newspapers"
    >
        <x-scholar.table>
            <thead>
                <tr>
                    <th>
                        Package/Duration
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Schedule
                    </th>
                    <th>
                        Paid
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newspapers as $b)
                    <tr>
                        <td>
                            {{$b->package->name}}
                        </td>
                        <td>
                            {{$b->status}}
                        </td>
                        <td>
                            {{$b->scheduled_at->format('m/d/y')}}
                        </td>
                        <td>
                            {{$b->wasPaid() ? 'yes' : 'no'}}
                        </td>
                        <td>
                            <a href="{{route('scholars.newspaper.show', ['newspaper' => $b->id])}}"  class="btn btn-xs" >
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
