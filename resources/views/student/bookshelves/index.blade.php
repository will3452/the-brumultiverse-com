<x-student.layout>
    <div class="h-screen overflow-y-auto w-screen bg-white backdrop-blur-sm" style="background: url('/students/bg-wood.jpg'); background-size: cover; background-position:center; ">
        <x-student.announcement />
        <x-student.slider />

        <x-student.search/>
        <div class="w-full h-full backdrop-blur-sm">
            <h1 class="px-4 text-2xl font-bold text-white mt-4">Bookshelves</h1>

            @if (is_null(request()->search))
                @foreach ($works as $key=>$w)
                    <x-student.work-container title="{{$key}}">
                        @foreach ($w as $wi)
                            <x-student.work-card :model="$wi" :url="route('student.bs.show', ['work' => $wi->id])"/>
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
