<div class="navbar bg-base-100 shadow-xl">
    <div class="flex-1">
      <a class="btn btn-ghost normal-case text-xl">{{config('app.name')}}</a>
    </div>
    <div class="flex-none">
    <div class="dropdown dropdown-end">
        <a href="#messages" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <x-nova.icon-bell/>
                <span class="badge badge-sm indicator-item">2</span>
            </div>
        </a>
        </div>
      <div class="dropdown dropdown-end">
        <a href="#messages" class="btn btn-ghost btn-circle">
            <div class="indicator">
              <x-nova.icon-message/>
              <span class="badge badge-sm indicator-item">8</span>
            </div>
        </a>
      </div>
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://api.lorem.space/image/face?hash=33791">
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          <li>
            <a class="justify-between">
              Profile
              {{-- <span class="badge">New</span> --}}
            </a>
          </li>
          <li><a>Settings</a></li>
          <li><a>Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
