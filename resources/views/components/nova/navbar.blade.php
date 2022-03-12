@props(['user' => null])
<div class="flex items-center relative shadow h-header bg-white z-20 px-view">
    <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
        {{ \Laravel\Nova\Nova::name() }}
    </a>
    @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
        <global-search dusk="global-search-component"></global-search>
    @endif
    <div class="ml-auto h-9 flex items-center">

        <x-nova.navbar-link href="{{auth()->user()->chat_url}}">
            <x-nova.icon-message/>
            <small class="text-xs bg-danger w-2 h-2 animate-bounce text-white flex items-center justify-center rounded-full">
            </small>
        </x-nova.navbar-link>

        <dropdown class="dropdown-right">
            @include('nova::partials.user')
        </dropdown>
    </div>

</div>
