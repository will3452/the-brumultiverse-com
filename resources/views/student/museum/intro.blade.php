<x-student.layout>
    <x-student.static-background-container bg="/students/museum-assets/base.png" blur="1">
        <div>
            <x-student.dialog-container :backdrop="false">
                <x-student.typing clear="0" message="Hi! I'm Anton. Would you like a tour?" />
                <x-student.dialog-button-container>
                    <a class="btn-student-active mx-2" href="{{route('student.museum.index')}}">
                        Ok
                    </a>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </div>
    </x-student.static-background-container>
</x-student.layout>
