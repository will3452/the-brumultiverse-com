
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
            <img src="/students/nav/gold.png" alt="" class="h-7 w-20">
            <img src="/students/nav/white.png" alt="" class="h-9 w-20">
            <img src="/students/nav/silver.png" alt="" class="h-7 w-20">
            <img src="/students/nav/purple.png" alt="" class="h-9 w-20">
            <img src="/students/nav/store.png" alt="" class="h-9">
        </div>
    @endif
        </div>
    </template>
    <div class="flex justify-end fixed w-screen z-50">
        <button class="btn m-2 btn-student-active btn-sm" x-on:click="hide = ! hide">
            <span class="text-xs">
                <span x-text="hide ? 'show' : 'hide'"></span> top
            </span>
        </button>
    </div>
</div>

<script>
    let topbarData = {
        hide:true,

    }
</script>
