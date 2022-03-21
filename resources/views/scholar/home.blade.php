<x-scholar.layout>
    <h1 class="text-2xl font-bold uppercase">
        Dashboard
    </h1>
    <div class="mt-4 flex flex-wrap justify-center md:justify-start">
        <x-scholar.dashboard-card icon="/img/icons/dashboard/book.svg" title="books" href="{{route('scholar.book.index')}}" />
        <x-scholar.dashboard-card icon="/img/icons/dashboard/speaker.svg" title="audio books" href="{{route('scholar.audiobook.index')}}"/>
        <x-scholar.dashboard-card icon="/img/icons/dashboard/image.svg" title="art scenes" href="{{route('scholar.artscene.index')}}" />
        <x-scholar.dashboard-card icon="/img/icons/dashboard/music.svg" title="songs" href="{{route('scholar.song.index')}}"/>
        <x-scholar.dashboard-card icon="/img/icons/dashboard/film.svg" title="films" href="{{route('scholar.film.index')}}"/>
        <x-scholar.dashboard-card icon="/img/icons/dashboard/mic.svg" title="podcasts" href="{{route('scholar.podcast.index')}}"/>
    </div>
    <div class="rounded text-xs border border-yellow-700 w-full p-4 bg-yellow-200 text-yellow-900">
        The ideal eBook cover size is 1,600 x 2,650 pixels. These dimensions give a height/width ratio of 1.6:1. They’re ideal as they ensure the best quality for your cover image.
    </div>
</x-scholar.layout>
