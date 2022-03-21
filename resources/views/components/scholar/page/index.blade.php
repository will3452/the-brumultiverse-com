@props(['creationLink' => '#', 'title' => 'Work', 'model' => [], 'type'=>null, 'data' => 'books', 'view' => 'scholar.book.index'])
<div class="items-center justify-between hidden md:flex">
    <div class="items-center flex justify-between md:justify-start sm:w-full md:w-1/2">
        <h1 class="text-2xl font-bold capatitalize">
            {{$title}}
        </h1>
        <a href="{{$creationLink}}" class="btn btn-primary btn-sm mx-2 capitalize">create new</a>
    </div>
    @if ($type != null)
    <form action="{{route('scholar.search')}}" class="flex hidden md:block">
        <input type="hidden" name="model" value="{{$type}}">
        <input type="hidden" name="view" value="{{$view}}">
        <input type="hidden" name="data" value="{{$data}}">
        <input type="text" required value="{{request()->keyword ?? ''}}" name="keyword" class="input input-bordered input-sm">
        <button class="btn btn-sm">Search</button>
    </form>
    @endif
</div>
<div class="md:hidden">
    @if ($type != null)
    <form class="mb-4 justify-center flex" action="{{route('scholar.search')}}">
        <input type="hidden" name="model" value="{{$type}}">
        <input type="hidden" name="view" value="{{$view}}">
        <input type="hidden" name="data" value="{{$data}}">
        <input type="text" required value="{{request()->keyword ?? ''}}" name="keyword" class="input input-bordered input-sm">
        <button class="btn btn-sm ml-1">Search</button>
    </form>
    @endif
    <div class="text-center capitalize text-2xl">
        {{$title}}
    </div>
</div>

{{$slot}}

<x-scholar.empty-index :data="$model"/>
<div class="fixed bottom-2 right-2 md:hidden">
    <a href="{{$creationLink}}" class="btn btn-primary btn-sm">create new</a>
</div>
