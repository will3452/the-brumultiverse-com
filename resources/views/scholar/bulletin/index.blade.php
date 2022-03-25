<x-scholar.layout>
    <x-scholar.page.title>
        Bulletin
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
                    'label' => 'Bulletins',
                ]
            ]
        "
    />
    <x-scholar.page.index
    type="Bulletin"
    data="bulletins"
    view="scholar.bulletin.index"
    :model="$bulletins"
    :creation-link="route('scholar.bulletin.create')"
    title="Bulletins"
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
                @foreach ($bulletins as $b)
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
                            <a href="{{route('scholar.bulletin.show', ['bulletin' => $b->id])}}"  class="underline underline-offset-1">
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
