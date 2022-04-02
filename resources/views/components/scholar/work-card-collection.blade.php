@props(['data' => [], 'href' => '#'])
<div class=" my-1 flex flex-wrap justify-start">
    @foreach ($data as $b)
        <x-scholar.work-card
            published="{{! is_null($b->published_at)}}"
            href="{{$href}}/{{$b->id}}"
            cover="{{$b->artFile ? optional($b->artFile)->getSize() : optional($b->cover)->getSize()}}">
            {{$b->title}}
        </x-scholar.work-card>
    @endforeach
</div>
