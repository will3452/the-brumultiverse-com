@if (auth()->check() && auth()->user()->isFinishedTutorial() && auth()->user()->hasAvatarSet())
    <div
        id="bottombar"
        class="h-16 bg-gray-900 fixed bottom-0 flex w-full justify-center items-center px-4"
        style="background:url('/students/nav/bottom-bg-min.png'); background-position:center; background-size:cover;">
        <x-student.icon-clickable normal="/students/nav/notification-min.png" active="/students/nav/notification-active-min.png" class="w-20 mx-2" />
        <x-student.icon-clickable normal="/students/nav/diary-min.png" active="/students/nav/diary-active-min.png" class="w-20 mx-2" />
        <x-student.icon-clickable href="{{route('student.map')}}" active="/students/nav/home-active-min.png" normal="/students/nav/home-min.png"  class="-top-5 w-32 relative"/>
        <x-student.icon-clickable href="{{route('student.bs.index')}}" normal="/students/nav/collection-min.png" active="/students/nav/collection-active-min.png" class="w-20 mx-2" />
        <x-student.icon-clickable normal="/students/nav/phone-min.png" active="/students/nav/phone-active-min.png" class="w-20 mx-2" />
    </div>
@else
<div id="bottombar"></div>
@endif
