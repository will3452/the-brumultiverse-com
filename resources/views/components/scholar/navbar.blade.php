<div class="navbar bg-base-100 border-b dark:bg-gray-900">
    <div class="flex-1">
      <img src="/bru_assets/textlogo.png" class="w-48" alt="">
    </div>
    <div class="flex-none">
    {{-- <div class="dropdown dropdown-hover dropdown-end"> --}}
    <div class="dropdown dropdown-end">
        <a tabindex="0" href="{{route('scholar.notification.index')}}" class="btn btn-ghost btn-circle">
            <div class="indicator dark:invert">
                <x-nova.icon-bell/>
                @if (auth()->user()->unread_notifications_count >= 1)
                    <span class="indicator-item w-1 h-1 rounded bg-purple-700 animate-pulse"></span>
                @endif
            </div>
        </a>
        {{-- <ul tabindex="0" class="dropdown-content menu p-2 border rounded bg-base-100  w-80">
            <li>
                @php
                  if (isset($notifications)) {
                      $ns = $notifications;
                  } else {
                      $ns = auth()->user()->notifications()->latest()->get();
                  }
              @endphp
                @foreach ($ns as $n)
                    <x-scholar.notification :href="$n->data['url']">
                        {{$n->data['message']}}
                    </x-scholar.notification>
                @endforeach
            </li>
        </ul> --}}
    </div>
      <div class="dropdown dropdown-end">
        <a target="_blank" href="{{auth()->user()->chat_url}}" class="btn btn-ghost btn-circle">
            <div class="indicator dark:invert">
                <x-nova.icon-message/>
              {{-- <span class="indicator-item badge badge-primary badge-xs"></span> --}}
            </div>
        </a>
      </div>
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full border">
            <img src="/img/profiles/30-30-{{auth()->user()->picture}}">
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 w-52 border">
          {{-- <li>
            <a class="justify-between">
              Profile
            </a>
          </li> --}}
          {{-- <li><a>Settings</a></li> --}}
          <li><a href="{{route('scholar.profile.show', ['user' => auth()->id()])}}">Profile</a></li>
          <li><a href="{{route('scholar.logout')}}">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
