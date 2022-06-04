
<div class="w-full  z-40" id="topbar" x-data="topbarData">
    <template x-if="! hide">
        <div>
            <div class=" w-full h-16 flex items-center justify-between px-1"

        style="background:url('/students/nav/bg.png'); background-position:top center; background-size:cover;"
        >
        <img src="/students/nav/circle-logo.png" class="w-10" alt="">
        <img src="/students/nav/text-logo.png" alt="" class="w-64">
    </div>
    @if (auth()->check() && auth()->user()->isFinishedTutorial())
        <div class="h-12 w-full bg-gradient-to-r from-blue-300 via-blue-900 to-purple-900 flex items-center justify-end">
            {{-- <img src="/students/nav/gold.png" alt="" class="h-7 w-20">
            <img src="/students/nav/white.png" alt="" class="h-9 w-20">
            <img src="/students/nav/silver.png" alt="" class="h-7 w-20">
            <img src="/students/nav/purple.png" alt="" class="h-9 w-20">
             --}}
            <x-student.top-balance label="Hall Pass" value="{{auth()->user()->balance->hall_pass}}"/>
            <x-student.top-balance label="Silver Ticket" value="{{auth()->user()->balance->silver_ticket}}"/>
            <x-student.top-balance label="Purple Crystal" value="{{auth()->user()->balance->purple_crystal}}"/>
            <x-student.top-balance label="White Crystal" value="{{auth()->user()->balance->white_crystal}}"/>
            <img src="/students/nav/store.png" alt="" class="h-9">
        </div>
    @endif
        </div>
    </template>
    <div class="flex justify-end fixed w-screen z-50">
        <button class="border-white bg-gradient-to-r from-blue-900 to-purple-900 text-white rounded-full hover:brightness-50 m-2" x-on:click="hide = ! hide">
            <template x-if="hide">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </template>
            <template x-if="! hide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
            </template>
        </button>
    </div>
</div>

<script>
    let topbarData = {
        hide:true,
    }
</script>
