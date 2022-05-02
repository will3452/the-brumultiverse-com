<x-student.layout>
    <x-student.static-background-container bg="{{getAsset(auth()->user()->getDorm())}}" blur="1">
        <div>
            <x-student.dialog-container>
                <x-student.typing clear="0" message="Your room is set up so that everything you need is within your reach. Wanna try this with me?" />
                <x-student.dialog-button-container>
                    <a class="btn-student-active mx-2" href="{{route('student.welcome.closet')}}">
                        Skip Tutorial
                    </a>
                    <a class="btn-student mx-2" href="{{route('student.dorm.tutorial')}}">
                        Let's Try
                    </a>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
            <x-student.scene >
                <img src="{{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
            </x-student.scene>
        </div>
    </x-student.static-background-container>
</x-student.layout>
