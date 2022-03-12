@props(['chat' => null, 'active' => false])
<a href="/chats/{{$chat->id}}" class="flex justify-between items-center p-2 border-t-2 {{! $active  ? : 'bg-blue-900 text-white'}}">
    <div class="-space-x-6 avatar-group">
        <div class="avatar">
            <div class="w-10 h-10">
            <img src="/storage/{{auth()->user()->picture}}" class="bg-white" alt="user image">
            </div>
        </div>
        @foreach ($chat->users as $user)
            @if ($user->id !== auth()->id())
                <div class="avatar">
                    <div class="w-10 h-10">
                    <img src="/storage/{{$user->picture}}" class="bg-white" alt="user image">
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div>
        <div class="font-bold flex items-center">
            {{$chat->conversation_name}}
            {{-- <span class="mx-2 block w-4 h-4 rounded-full animate-pulse bg-green-400"></span> --}}
        </div>
        <div class="text-xs">
            {{$chat->updated_at->diffForHumans()}}
        </div>
    </div>
</a>
