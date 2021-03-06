<x-student.layout>
    <x-student.static-background-container bg="/students/library-assets/base.png" blur="1">
        <div>
            <x-student.dialog-container :small="true">
                <x-student.typing clear="0" message="Looking for any book in particular? I'm Julio, by the way." />
                <x-student.dialog-button-container>
                    <a class="btn-student-active mx-2" href="{{route('student.library.index')}}">
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
