@props(['creationLink' => null, 'title' => 'Work', 'model' => [], 'type'=>null, 'data' => 'books', 'view' => 'scholar.book.index'])
<div class="items-center justify-between hidden md:flex mt-2">
    @if (! is_null($creationLink))
        <div class="items-center flex justify-between md:justify-start sm:w-full md:w-1/2">
            <a href="{{$creationLink}}" class="btn btn-primary btn-sm capitalize tracking-widest">create new</a>
        </div>
    @endif
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
</div>

{{$slot}}

<x-scholar.empty-index :data="$model"/>
@if (! is_null($creationLink))
    <div class="fixed bottom-2 right-2 md:hidden">
        <a href="{{$creationLink}}" class="btn btn-primary btn-sm">create new</a>
    </div>
@endif
