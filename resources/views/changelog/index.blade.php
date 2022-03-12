<x-home-layout>
    <div class="text-center mt-4">
        <h2 class="uppercase text-3xl font-bold mb-8">
            Update Logs
        </h2>
    </div>
    <x-home-text-container>
        @foreach ($changelogs as $log)
            <x-vspace>
                <div class="border-dashed border-2 p-4 my-4">
                    <div>
                        <div class="font-bold text-xl uppercase">
                            {{$log->title}}
                        </div>
                        <div class="text-xs">
                            {{$log->created_at}}
                        </div>
                    </div>
                    <div style="max-height:100px; overflow-y:auto;">
                        {{$log->description}}
                    </div>
                </div>
            </x-vspace>
        @endforeach
        {{$changelogs->links()}}
    </x-home-text-container>
</x-home-layout>
