<x-scholar.layout>
    <x-scholar.page.title>
        Message Blast
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
                    'label' => 'Message Blasts',
                ]
            ]
        "
    />
    <x-scholar.page.index
    data="bulletins"
    view="scholar.message-blast.index"
    :model="$messageBlasts"
    :creation-link="route('scholar.message-blast.create')"
    title="Message Blasts"
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
                @foreach ($messageBlasts as $m)
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
                            <a href="{{route('scholar.message-blast.show', ['messageBlast' => $m->id])}}"  class="btn btn-xs" >
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
