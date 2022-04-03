<x-scholar.layout>
    <div class="flex">
        <div class="w-full md:w-10/12">
            <div class="flex items-center">
                <x-scholar.page.title>
                    Dashboard
                </x-scholar.page.title>
                <span class="uppercase text-xs font-bold text-gray-600 ml-4">
                    Last Login At: {{auth()->user()->last_login_at ?? auth()->user()->last_login_at->format('M d,y h:i a')}}
                </span>
            </div>
            <x-scholar.material-container title="Materials" icon="/img/icons/dashboard/folder.svg">
                <x-scholar.dashboard-card icon="/img/icons/dashboard/book.svg" title="books" href="{{route('scholar.book.index')}}" />
                <x-scholar.dashboard-card icon="/img/icons/dashboard/speaker.svg" title="audio books" href="{{route('scholar.audiobook.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/image.svg" title="art scenes" href="{{route('scholar.artscene.index')}}" />
                <x-scholar.dashboard-card icon="/img/icons/dashboard/music.svg" title="songs" href="{{route('scholar.song.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/film.svg" title="films" href="{{route('scholar.film.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/mic.svg" title="podcasts" href="{{route('scholar.podcast.index')}}"/>
            </x-scholar.material-container>

            <x-scholar.material-container title="Marketing" icon="/img/icons/dashboard/trending-up.svg">
                <x-scholar.dashboard-card icon="/img/icons/dashboard/ballot_black_24dp.svg" title="bulletin" href="{{route('scholar.bulletin.index')}}" />
                <x-scholar.dashboard-card icon="/img/icons/dashboard/sort_black_24dp.svg" title="marquee" href="{{route('scholar.marquee.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/slideshow_black_24dp.svg" title="sliding banner" href="{{route('scholar.sliding-banner.index')}}" />
                <x-scholar.dashboard-card  icon="/img/icons/dashboard/quickreply_black_24dp.svg" title="message blast" href="{{route('scholar.message-blast.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/insert_photo_black_24dp.svg" title="loading image" href="{{route('scholar.loading-image.index')}}"/>
                <x-scholar.dashboard-card icon="/img/icons/dashboard/newspaper_black_24dp.svg" title="newspaper" href="{{route('scholar.newspaper.index')}}"/>
            </x-scholar.material-container>

            <x-dev.changelog/>
        </div>
        <div class="w-2/12 bg-base-100 hidden md:block">
            {{-- extra space --}}
        </div>
    </div>

    @push('head-script')
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
