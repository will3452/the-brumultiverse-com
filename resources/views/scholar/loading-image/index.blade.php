<x-scholar.layout>
    <x-scholar.page.title>
        Loading Image
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
                    'label' => 'Loading Images',
                ]
            ]
        "
    />
    <x-scholar.page.index
    data="slidingBanners"
    view="scholar.loading-image.index"
    :model="$loadingImages"
    :creation-link="route('scholar.loading-image.create')"
    title="Loading Images"
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
                @foreach ($loadingImages as $m)
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
                            <a href="{{route('scholar.loading-image.show', ['loadingImage' => $m->id])}}"  class="underline underline-offset-1">
                                show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </x-scholar.page.index>
</x-scholar.layout>
