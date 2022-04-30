<x-scholar.layout>
    <x-scholar.page.title>Events</x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Events',
                ]
            ]
        "
    />
    <x-scholar.page.index creation-link="{{route('scholars.event.create')}}" title="Event" :model="$events" type="Event" data="events" view="scholar.event.index">
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
                        Status
                    </th>
                    <th>
                        From
                    </th>
                    <th>
                        To
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>
                            {{$event->created_at->format('m/d/y')}}
                        </td>
                        <td>
                            {{$event->title}}
                        </td>
                        <td>
                            {{$event->status}}
                        </td>
                        <td>
                            {{$event->start_date->format('m/d/y')}}
                        </td>
                        <td>
                            {{$event->end_date->format('m/d/y')}}
                        </td>
                        <td>
                            <a href="{{route('scholars.event.show', ['event' => $event])}}" class=" btn-sm btn-scholar btn">
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
