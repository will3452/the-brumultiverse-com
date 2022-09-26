<x-student.layout bg="bg-white">
    <div class="h-screen flex flex-col md:flex-row">
        <div class="overflow-y-scroll h-full w-full mx-auto p-4 pb-32">
            <div class=" p-4 mt-5">
                <div class="flex items-center justify-center">
                    <h1 class="text-center text-2xl m-4">{{$book->title}}</h1>
                    <small>by {{$book->account->penname}}</small>
                </div>
                {{-- if the users has enough balance to proceed --}}
                @if (auth()->user()->canProceedToRead($book, $chapter))
                <h1 class="text-center text-2xl mt-4">You're about to the next page, do you want to continue?</h1>
                <div class="text-center mt-4">
                    <a class="btn btn-student-active" href="{{route('student.readinglog.save')}}?chapter_id={{$chapter->id}}&book_id={{$book->id}}&page_number={{$page}}">yes</a>
                    <a class="btn btn-student" href="{{route('student.dorm.me')}}">no</a>
                </div>
                @else
                <h1 class="text-center text-2xl mt-4">You don't have balance to keep reading.</h1>
                <div class="text-center mt-4">
                    <a class="btn btn-student-active" href="{{route('student.dorm.me')}}">Back to dorm</a>
                </div>
                @endif
            </div>
            <div class="">
                <h3 class="text-center text-xl font-bold uppercase mt-10">
                    Comments
                </h3>
                @forelse  (\App\Models\Comment::where(['model_type' => '\\App\\Models\\BookContentChapter', 'model_id' => $chapter->id])->latest()->take(3)->get() as $i)
                    <div class=" p-2">
                        {{-- <div class="w-12 h-12 bg-gray-500 rounded"></div> --}}
                        <div class="text-xs font-bold">{{$i->user->user_name}}</div>
                        <div class="text-xl">
                            {{$i->text}}
                        </div>
                        <small>{{$i->created_at->diffForHumans()}}</small>
                    </div>
                    {{-- <div class="text-right   mt-4 underline lowercase underline-offset-2 text-sm">View more comments</div> --}}
                @empty
                <div class="text-xl text-center text-gray-700 my-2">
                    No comment found.
                </div>
                @endforelse
                @if (! $chapter->hasAlreadyComment('\\App\\Models\\BookContentChapter', auth()->id()))
                    <form action="{{route('comment')}}" method="POST">
                        @csrf
                        <div class="my-2">Write your comment below!</div>
                        <input type="hidden" name="model_type" value="\App\Models\BookContentChapter">
                        <input type="hidden" name="model_id" value="{{$chapter->id}}">
                        <textarea name="text" id="" cols="30" rows="5" class="w-full textarea textarea-bordered"></textarea>
                        <div class="text-right">
                            <button class="btn btn-student-active">Send comment</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-student.layout>
