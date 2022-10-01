<x-student.layout bg="bg-scholar">
    <div class="flex">
        <div class="w-full p-4">
            <x-scholar.page.title>
                Messages
            </x-scholar.page.title>
            <div class="text-red-700">
               * All Conversation will be deleted after 30 days.
            </div>
            <div class="flex w-full">
                <div class="w-10/12 h-screen relative border-r mt-4 p-2">
                    <div class="overflow-y-auto" style="height:50vh !important;">
                        @foreach ($chat->messages()->orderBy('created_at')->get() as $item)
                        @if ($item->user_id === auth()->id())
                        <div class="message-me">
                            <span>
                                <div class="message">
                                    {{$item->message}}
                                </div>
                                <small class="text-white text-xs">{{$item->created_at->diffForHumans()}}</small>
                            </span>
                        </div>
                        @else
                        <div class="message-other">
                            <span>
                                <div class="message">
                                    {{$item->message}}
                                </div>
                                <small class="text-white text-xs">{{$item->created_at->diffForHumans()}}</small>
                            </span>
                        </div>
                        @endif
                    @endforeach
                        <div id="last"></div>
                    </div>

                    <form class="flex items-start absolute bottom-2 w-full" action="{{route('student.chat.create.message', ['chat' => $chat->id])}}" method="POST">
                        @csrf
                        <textarea name="message" required id="" cols="30" rows="10" class="text-gray-900 border w-10/12 p-2" placeholder="Aa"></textarea>
                        <button class="btn btn-sm ml-2">send</button>
                    </form>
                </div>
                <div class="w-4/12">
                    <a class="text-center uppercase block p-2 border bg-active" href="{{route('student.chat.create')}}">create new</a>
                    @foreach ($chats as $item)
                        <a href="{{route('student.chat.index', ['chat' => $item->id])}}" class=" {{$item->id == $chat->id ? 'bg-gray-100':''}} block w-full border text-gray-900 p-2 text-right">
                            {{ implode(', ', $item->getUsersList()->toArray()) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('head-script')
        <x-vendor.alpinejs/>
        <x-vendor.ckeditor/>
    @endpush
</x-student.layout>
