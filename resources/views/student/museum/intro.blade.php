<x-student.layout>
    <x-student.static-background-container bg="/students/museum-assets/base.png" blur="1">
        <div>
            <x-student.dialog-container>
                <x-student.typing clear="0" message="Hi! I'm Anton. Would you like a tour?" />
                <x-student.dialog-button-container>
                    <a class="btn-student-active mx-2" href="{{route('student.museum.index')}}">
                        Yes
                    </a>
                    <a class="btn-student mx-2" href="{{route('student.map')}}">
                        No
                    </a>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </div>
    </x-student.static-background-container>
</x-student.layout>
