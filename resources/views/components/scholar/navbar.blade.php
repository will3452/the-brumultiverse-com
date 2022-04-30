<div class="navbar border-b dark:bg-gray-900">
    <div class="flex-1 items-center flex">
      <img src="{{getAsset('home/textlogo.png')}}" class="w-48" alt="">
       <form action="javascript:alert('under developmemt')" class="flex items-center hidden md:flex">
           <div>
            <input type="text" class="input input-bordered input-sm" placeholder="Search here">
           </div>
           <div>
            <button class="btn btn-primary btn-sm ml-1">
                <img src="/img/icons/crud/search.svg" alt="" class="invert">
                Search
            </button>
           </div>
       </form>
    </div>
    <div class="flex-none">
        <div class="dropdown dropdown-end">
            <a tabindex="0" href="{{route('scholars.group.invitation')}}" class="btn btn-ghost btn-circle">
                <div class="indicator dark:invert">
                    <x-nova.icon-group-add/>
                </div>
            </a>
        </div>
        <div class="dropdown dropdown-end">
            <a tabindex="0" href="{{route('scholars.notification.index')}}" class="btn btn-ghost btn-circle">
                <div class="indicator dark:invert">
                    <x-nova.icon-bell/>
                    @if (auth()->user()->unread_notifications_count >= 1)
                        <span class="indicator-item w-1 h-1 rounded bg-purple-700 animate-pulse"></span>
                    @endif
                </div>
            </a>
        </div>
        <div class="dropdown dropdown-end">
            <a target="_blank" href="{{auth()->user()->chat_url}}" class="btn btn-ghost btn-circle">
                <div class="indicator dark:invert">
                    <x-nova.icon-message/>
                </div>
            </a>
        </div>

        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
            <div class="w-10 rounded-full border indicator">
                <img src="/img/profiles/30-30-{{auth()->user()->picture}}">
            </div>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 w-52 border">
                <li><a href="{{route('scholars.profile.show', ['user' => auth()->id()])}}">Profile</a></li>
                <li><a href="{{route('scholars.transaction.index')}}">Payment</a></li>
                <li><a href="javascript:alert('under development!')">Reports</a></li>
                <li><a href="{{route('scholars.logout')}}">Logout</a></li>
            </ul>
        </div>
    </div>
  </div>
