<x-student.layout>
    @auth
        <x-student.place.map/>
    @else
        <x-student.place.guest-map/>
    @endauth
</x-student.layout>
