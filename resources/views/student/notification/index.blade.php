<x-student.layout bg="bg-student h-screen overflow-auto ">
    <h1 class="text-center text-2xl p-4">
        Notifications
    </h1>
    <div class="px-4">
        @foreach ($notifications as $n)
            <x-student.notification :model="$n">
                {{$n->data['message']}}
                <x-slot name="time">
                    {{$n->created_at->diffForHumans()}}
                </x-slot>
            </x-student.notification>
        @endforeach
    </div>
</x-student.layout>
