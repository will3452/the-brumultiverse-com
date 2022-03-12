<x-scholar.layout>
    <h1 class="text-2xl font-bold uppercase">
        Welcome User!
    </h1>
    <h2  class="text-center text-lg">
        Share your works!
    </h2>
    <div class="mt-4 flex flex-wrap">
        <x-scholar.dashboard-card title="books" href="{{route('scholar.book.index')}}" />
        <x-scholar.dashboard-card title="audio books" />
        <x-scholar.dashboard-card title="art scenes" />
        <x-scholar.dashboard-card title="songs" />
        <x-scholar.dashboard-card title="films" />
        <x-scholar.dashboard-card title="podcasts" />
    </div>
</x-scholar.layout>
