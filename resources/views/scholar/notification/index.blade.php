<x-scholar.layout>
    <x-scholar.page.title>
        Notifications
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
                'label' => 'Notifications',
            ]
        ]
    "
/>
<div>
    @foreach ($notifications as $n)
        <x-scholar.notification :model="$n">
            {{$n->data['message']}}
            <x-slot name="time">
                {{$n->created_at->diffForHumans()}}
            </x-slot>
        </x-scholar.notification>
    @endforeach
</div>
</x-scholar.layout>
