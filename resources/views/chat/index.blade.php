<x-layout>
    <div class="w-screen h-screen overflow-hidden">
        <x-chat.navbar/>
    <x-chat.breadcrumbs
    :links="[
        ['label' => 'Dashboard', 'href' => Nova::path()],
        ['label' => 'Conversation', 'href' => auth()->user()->chat_url],
    ]"/>
    <div class="flex w-screen h-screen">
        <div class="w-3/12 h-full border-r-2 border-t-2 overflow-y-auto">
            {{-- search user --}}
                {{-- <x-chat.search-user/> --}}
                <a href="/chats/create" class="btn btn-dark text-white rounded-none btn-sm btn-block">Add New Conversation</a>
            {{-- end users --}}

            {{-- list of chats --}}
                @foreach ($chats as $item)
                    <x-chat.chat-link :chat="$item" :active="$item->id === $chat->id"/>
                @endforeach
            {{-- end of chats --}}
        </div>
        <div class="w-9/12 h-full bg-white relative">

            {{-- messages name --}}
            <div class="bg-gray-200 p-2 font-bold uppercase">
                {{$chat->conversation_name}}
            </div>
            <chat-panel :chat="{{$chat}}" user="{{auth()->id()}}"></chat-panel>
        </div>
    </div>
    </div>
</x-layout>
