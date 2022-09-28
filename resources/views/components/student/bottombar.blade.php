@if (auth()->check() && auth()->user()->isFinishedTutorial() && auth()->user()->hasAvatarSet())
    <div
        id="bottombar"
        class="h-16 bg-gray-900 fixed bottom-0 flex w-full justify-center items-center px-4"
        style="background:url('/students/nav/bottom-bg-min.png'); background-position:center; background-size:cover;">
        <img src="/students/nav/text-logo.png" alt="" class="w-64">
        <x-student.icon-clickable href="{{route('student.notification.index')}}" normal="/students/nav/notification-min.png" active="/students/nav/notification-active-min.png" class="w-12 mx-2" />
        <x-student.icon-clickable href="{{route('student.diary.index')}}" normal="/students/nav/diary-min.png" active="/students/nav/diary-active-min.png" class="w-12 mx-2" />
        <x-student.icon-clickable href="{{route('student.map')}}" active="/students/nav/home-active-min.png" normal="/students/nav/home-min.png"  class="-top-5 w-20 relative"/>
        <x-student.icon-clickable href="{{route('student.bs.index')}}" normal="/students/nav/collection-min.png" active="/students/nav/collection-active-min.png" class="w-12 mx-2" />
        <x-student.icon-clickable href="{{route('student.phone.index')}}" normal="/students/nav/phone-min.png" active="/students/nav/phone-active-min.png" class="w-12 mx-2" />
        <div  class="w-84 flex items-center">
            <x-student.top-balance label="HALL PASS" normal="/students/nav/gold-min.png" class="w-16" value="{{auth()->user()->balance->hall_pass}}"/>
            <x-student.top-balance label="SILVER TICKET" normal="/students/nav/silver-min.png" value="{{auth()->user()->balance->silver_ticket}}"/>
            <x-student.top-balance label="PURPLE CRYSTAL" normal="/students/nav/purple-min.png" value="{{auth()->user()->balance->purple_crystal}}"/>
            <x-student.top-balance label="WHITE CRYSTAL" normal="/students/nav/white-min.png" value="{{auth()->user()->balance->white_crystal}}"/>
        </div>
    </div>
@else
<div id="bottombar"></div>
@endif
