<x-student.layout bg="bg-white">
    <h1 class="text-center text-2xl p-4">
        Notifications
    </h1>
    @foreach ($notifications as $n)
        <x-scholar.notification :model="$n">
            {{$n->data['message']}}
            <x-slot name="time">
                {{$n->created_at->diffForHumans()}}
            </x-slot>
        </x-scholar.notification>
    @endforeach
</x-student.layout>
