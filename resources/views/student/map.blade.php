<x-student.layout>
    <x-student.loader/>
    @auth
        <x-student.place.map/>
    @else
        <x-student.place.guest-map/>
    @endauth
    @push('head-script')
        <x-bg-sound path="/sounds/map.mp3"></x-bg-sound>
    @endpush
</x-student.layout>
