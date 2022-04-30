<x-scholar.layout>
    <x-scholar.page.title>
        Groups
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Group',
                ]
            ]
        "
    />
    <x-scholar.page.index creation-link="{{route('scholars.group.create')}}" title="Group" :model="$memberships" data="memberships" view="scholar.group.index">
        <x-scholar.table>
            <thead>
                <tr>
                    <th>Date Created</th>
                    <th>Group Name</th>
                    <th>Group Type</th>
                    <th>Status</th>
                    <th>Members</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($memberships as $m)
                    <tr>
                        <td>
                            {{$m->group->created_at->format('m/d/y')}}
                        </td>
                        <td>
                            {{$m->group->name}}
                        </td>
                        <td>
                            {{$m->group->type}}
                        </td>
                        <td>
                            {{$m->group->status}}
                        </td>
                        <td>
                            {{$m->group->members_count}}
                        </td>
                        <td>
                            <a class="btn-scholar btn-sm btn" href="{{route('scholars.group.show', ['group' => $m->group])}}">show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
