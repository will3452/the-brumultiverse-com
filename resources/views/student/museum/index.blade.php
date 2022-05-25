<x-student.layout>
    <div class="h-screen overflow-y-auto w-screen bg-white mt-28">
        <x-student.announcement />
        <x-student.slider />

        <x-student.search/>

        @if (is_null(request()->search))
            @foreach ($works as $key=>$w)
                <x-student.work-container title="{{$key}}">
                    @foreach ($w as $wi)
                        <x-student.work-card :model="$wi"/>
                    @endforeach
                </x-student.work-container>
            @endforeach

        @else
            <x-student.work-container title="Search results:">
                @forelse ($works as $model)
                    <x-student.work-card :model="$model"/>
                @empty
                    <div>
                        No found.
                    </div>
                @endforelse
            </x-student.work-container>
        @endif

        <div class="mb-52"></div>
    </div>
    @push('head-script')
        <x-vendor.slickcss/>
    @endpush

    @push('head-script')
        <x-vendor.slickjs />
    @endpush
    @push('body-script')
    @endpush
</x-student.layout>
