<x-layout>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <x-chat.navbar/>
    <x-chat.breadcrumbs
    :links="[
        ['label' => 'Dashboard', 'href' => Nova::path()],
        ['label' => 'Conversation', 'href' => auth()->user()->chat_url],
        ['label' => 'New', 'href' => '/chats/create'],
    ]"/>

    <div class="bg-white flex">
        <form action="/chats" method="POST" class="w-4/12 mx-auto">
            @csrf
            <x-vspace>
                <label for="" class="block font-bold uppercase pt-4">Select User to chat</label>
                <select name="user_id" id="" required class="js-example-basic-single w-full form-control">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">
                            {{$user->user_name}}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                <small class="text-xs text-red-600 font-bold">{{$message}}</small>
                @enderror
            </x-vspace>
            <x-vspace>
                <button class="btn btn-sm rounded-none">
                    Create Conversation
                </button>
            </x-vspace>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</x-layout>
