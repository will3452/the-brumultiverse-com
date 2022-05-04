<x-student.layout>
    <div class="h-screen overflow-y-auto w-screen bg-white mt-28">
        <x-student.announcement />
        <x-student.slider />
        <x-student.search/>

        @foreach ($works as $key=>$w)
        <x-student.work-container title="{{$key}}">
            @foreach ($w as $wi)
                <x-student.work-card :model="$wi"/>
            @endforeach
        </x-student.work-container>
        @endforeach
        <button id="modal-1">click me</button>
        <div class="mb-52"></div>
    </div>
    @push('head-script')
        <x-vendor.slickcss/>
    @endpush

    @push('head-script')
        <x-vendor.slickjs />
    @endpush
    @push('body-script')
    <script>
        document.getElementById('modal-1').onclick = function() {
            Modal.open({
                content: `<strong>Default modal!</strong>
                        <br />Testing the modal.
                        <br /><
                        br />Loreum ipsum dolorem the quick brown
                        fox jumped over the lazy dog.
                        <br /><br />Yes its true.`,
                draggable: true,
            });
            }
    </script>
    @endpush
</x-student.layout>
