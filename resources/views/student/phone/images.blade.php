<x-student.layout>
    <div class="h-screen overflow-y-auto w-screen bg-white">

        <x-student.search/>

        <h1 class="px-4 text-2xl font-bold text-gray-400 mt-4">Images from your phone</h1>

        @if (is_null(request()->search))
            @foreach ($works as $key=>$w)
                <x-student.work-container title="{{$key}}">
                    @foreach ($w as $wi)
                        <x-student.work-card :model="$wi" :url="route('student.phone.photo.view', ['path' => $wi->artFile->path])"/>
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
