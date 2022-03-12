<div class="container w-full md:w-11/12 mx-auto mt-4 md:p-0 p-1 relative">
    @if (session()->has('success'))
        <x-scholar.alert-success>
            {{session()->get('success')}}
        </x-scholar.alert-success>
    @endif
    {{$slot}}
</div>
