<x-scholar.layout>
    <div class="flex items-center">
        <x-scholar.page.title>
            Dashboard
        </x-scholar.page.title>
        <span class="uppercase text-xs font-bold text-gray-600 ml-4">
            Last Login At: {{auth()->user()->last_login_at->format('m d,y h:i a')}}
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
    {{-- <div class="rounded text-xs border border-yellow-700 w-full p-4 bg-yellow-200 text-yellow-900">
        The ideal eBook cover size is 1,600 x 2,650 pixels. These dimensions give a height/width ratio of 1.6:1. They’re ideal as they ensure the best quality for your cover image.
    </div> --}}
    <x-scholar.material-container title="Development Changelog" icon="/img/icons/crud/upload.svg">
        <ul class="list-disc list-inside">
            @foreach (\App\Models\ChangeLog::latest()->get() as $item)
                <li class="mt-2">
                    <span>{{$item->title}}</span> | {{$item->description}} <span class="text-xs">{{$item->created_at->diffForHumans()}}</span>
                </li>
            @endforeach
        </ul>
    </x-scholar.material-container>
    @push('head-script')
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
