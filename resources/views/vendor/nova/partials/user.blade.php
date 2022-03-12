<dropdown-trigger class="h-9 flex items-center">
    @isset(auth()->user()->picture)
        <img
            src="/storage/{{auth()->user()->picture}}"
            class="rounded-full w-8 h-8 mr-3 border-2"
        />
    @endisset

    <span class="text-90">
        {{ auth()->user()->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        @if (! auth()->user()->hasRole(\App\Models\User::ROLE_NORMAL))
            <li>
                <a href="{{Nova::path() . '/bru-profile'}}" class="block no-underline text-90 hover:bg-30 p-3">
                    {{ __('Profile') }}
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
