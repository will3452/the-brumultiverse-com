<div class="w-full mx-auto flex">
    <div class="w-2/12 h-screen overflow-y-auto hidden md:block border-r">
        <ul>
            <x-scholar.sidebar-item label="Dashboard" :href="route('scholar.home')"/>
        </ul>
    </div>
    <div class="w-full md:w-10/12 p-4 relative h-screen overflow-y-auto">
        @if (session()->has('success'))
            <x-scholar.alert-success>
                {{session()->get('success')}}
            </x-scholar.alert-success>
        @endif
        {{$slot}}
    </div>
</div>
