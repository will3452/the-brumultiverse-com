<x-student.layout>
    <x-student.static-background-container bg="{{getAsset('/closet/base.png')}}">
        <div x-data="data">
            <template x-if="step == 1">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing clear="0" message="I saw some of your clothes. They're amazing. Wanna change into something more comfortable than your travel clothes?" />
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mx-2" x-on:click="step++">
                                Ok
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
            </template>
            <template x-if="step == 2">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing clear="0" message="Great! Let's get to it. I can be your personal stylist today." />
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mx-2" x-on:click="step++">
                                Proceed
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
            </template>
        </div>
    </x-student.static-background-container>

    @push('body-script')
        <script>
            var data = {
                step:0,
                init() {
                    this.step = {{request()->step ?? 1}};
                }
            }
        </script>
    @endpush
</x-student.layout>
