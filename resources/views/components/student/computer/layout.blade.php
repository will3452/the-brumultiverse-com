<x-student.layout>
    <div class="flex h-screen bg-white">
        <div class="w-3/12 h-full bg-gray-200">
            <div class="text-center bg-gray-900 font-bold text-white p-4 uppercase">My Computer</div>
            <ul>
                <x-scholar.sidebar-item label="My Collections" :href="route('student.computer.dashboard')" />
                <x-scholar.sidebar-item label="Settings" :href="route('student.computer.setting')" />
                <x-scholar.sidebar-item label="Homeworks" :href="route('student.computer.homework')" />
                <x-scholar.sidebar-item label="Write with us" :href="route('student.computer.write')" />
                <x-scholar.sidebar-item label="Shutdown" :href="route('student.dorm.me')" />
            </ul>
        </div>
        <div class="w-9/12 h-full bg-gray-100 p-4 overflow-y-auto pb-20">
            {{$slot}}
        </div>
    </div>
</x-student.layout>
