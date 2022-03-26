<x-scholar.layout>
    <x-scholar.page.title>
        Sliding Banner
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
                    'label' => 'Sliding Banners',
                ]
            ]
        "
    />
    <x-scholar.page.index
    data="slidingBanners"
    view="scholar.sliding-banner.index"
    :model="$slidingBanners"
    :creation-link="route('scholar.sliding-banner.create')"
    title="Sliding Banners"
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
                @foreach ($slidingBanners as $m)
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
                            <a href="{{route('scholar.sliding-banner.show', ['slidingBanner' => $m->id])}}"  class="underline underline-offset-1">
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
