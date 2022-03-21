<div class="navbar bg-base-100 border-b">
    <div class="flex-1">
      <img src="/bru_assets/textlogo.png" class="w-48" alt="">
    </div>
    <div class="flex-none">
    <div class="dropdown dropdown-end">
        <a href="#messages" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <x-nova.icon-bell/>
                <span class="indicator-item badge badge-primary badge-xs"></span>
            </div>
        </a>
        </div>
      <div class="dropdown dropdown-end">
        <a target="_blank" href="{{auth()->user()->chat_url}}" class="btn btn-ghost btn-circle">
            <div class="indicator">
              <x-nova.icon-message/>
              <span class="indicator-item badge badge-primary badge-xs"></span>
            </div>
        </a>
      </div>
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full border">
            <img src="/storage/{{auth()->user()->picture}}">
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 w-52 border">
          {{-- <li>
            <a class="justify-between">
              Profile
            </a>
          </li> --}}
          {{-- <li><a>Settings</a></li> --}}
          <li><a href="{{route('scholar.logout')}}">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
