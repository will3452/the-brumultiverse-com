<x-scholar.layout>
    <x-scholar.page.title>
        Marquee
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
                    'label' => 'Marquees',
                ]
            ]
        "
    />
    <x-scholar.page.index
    data="marquees"
    view="scholar.marquee.index"
    :model="$marquees"
    :creation-link="route('scholars.marquee.create')"
    title="Marquees"
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
                @foreach ($marquees as $m)
                    <tr>
                        <td>
                            {{$m->package->name}}
                        </td>
                        <td>
                            {{$m->status}}
                        </td>
                        <td>
                            {{$m->scheduled_at->format('m/d/y')}}
                        </td>
                        <td>
                            {{$m->wasPaid() ? 'yes' : 'no'}}
                        </td>
                        <td>
                            <a href="{{route('scholars.marquee.show', ['marquee' => $m->id])}}"  class="btn btn-xs" >
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
