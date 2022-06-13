<div class="w-full mx-auto flex relative">
    @auth
    <div class="w-2/12 h-screen overflow-y-auto hidden md:block border-r">
        <ul>
            <x-scholar.sidebar-item label="Dashboard" :href="route('scholar.home')"/>
            <x-scholar.sidebar-item label="Events" :href="route('scholar.event.index')"/>
            <x-scholar.sidebar-item label="Profile" :href="route('scholar.profile.show', ['user' => auth()->id()])"/>
            <x-scholar.sidebar-item label="Groups" :href="route('scholar.group.index')" />
            <x-scholar.sidebar-item label="Payments" :href="route('scholar.transaction.index')"/>
            <x-scholar.sidebar-item label="Messages" :href="auth()->user()->getChat(1)" />
            <x-scholar.sidebar-item label="Reports" href="javascript:alert('underdevelopment')"/>
        </ul>

    </div>
    @endauth
    <div class="w-10/12 relative h-screen overflow-y-auto mx-auto">
        {{$alert}}
        <div class="p-4">
            {{$slot}}
        </div>
    </div>
</div>
