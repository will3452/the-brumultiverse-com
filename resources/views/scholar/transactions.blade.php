<x-scholar.layout>
    <x-scholar.page.title>
        Payments history
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
                    'label' => 'Payment History',
                ]
            ]
        "
    />

    <x-scholar.page.index
    :model="$transactions"
    data="transactions">
    <x-scholar.table>
        <thead>
            <tr>
                <th>
                    Ref. No.
                </th>
                <th>
                    Status
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Description
                </th>
                <th>
                    Date
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $t)
                <tr>
                    <td>
                        {{$t->ref_no}}
                    </td>
                    <td>
                        {{$t->status}}
                    </td>
                    <td>
                        PHP {{number_format($t->amount, 2)}}
                    </td>
                    <td>
                        {{$t->description}}
                    </td>
                    <td>
                        {{$t->created_at->format('m/d/y h:i A')}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-scholar.table>
    </x-scholar.page.index>

</x-scholar.layout>
