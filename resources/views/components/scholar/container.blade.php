<div class="w-full mx-auto flex">
    <div class="w-2/12 h-screen overflow-y-auto hidden md:block border-r">
        <ul>
            <x-scholar.sidebar-item label="Dashboard" :href="route('scholar.home')"/>
            <x-scholar.sidebar-item label="Profile" :href="route('scholar.profile.show', ['user' => auth()->id()])"/>
        </ul>
    </div>
    <div class="w-full md:w-10/12 p-4 relative h-screen overflow-y-auto">
        {{$slot}}
    </div>
</div>
