@php
    $bugs = \App\Models\Bug::whereStatus('Pending')->whereUri(url()->current())->get();
@endphp
    <x-scholar.modal no-button="1" id="report-form">
        <x-slot name="trigger">
            <label for="report-form" class="btn btn-accent btn-xs fixed bottom-2 right-2 font-bold">Report Bug here <span class="badge badge-primary badge-xs w-4 w-4">{{count($bugs)}}</span></label>
        </x-slot>
        <form action="{{route('dev.submit.bug')}}" method="POST">
            @csrf
            <input type="hidden" name="uri" value="{{url()->current()}}">
            <span class="italic text-red-500 text-sm">{{url()->current()}}</span>
            <x-scholar.form.ckeditor label="Problem/Issue" name="problem"/>
            <x-scholar.form.ckeditor label="Replacement" name="replacement"/>
            <x-scholar.form.submit>
                Submit
            </x-scholar.form.submit>
            <ul>

                <h1 class="font-bold text-right">Bug(s) Reported.</h1>
                @foreach ($bugs as $b)
                    <li class="text-sm mt-4 p-2 border-dashed border-2 ">
                        <div>
                            <span class="font-bold">Problem: </span>
                            {{$b->problem}}
                        </div>
                        <div>
                            <span class="font-bold">Replacement: </span>
                            {{$b->replacement}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </form>
    </x-scholar.modal>
