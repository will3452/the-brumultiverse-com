<x-student.layout bg="bg-scholar h-screen overflow-auto">
    <h1 class="text-center text-2xl p-4">
        Contacts
    </h1>
    <div class="text-center mb-2">
        <a href="?filter=list" class="{{request()->filter == 'request' ? '':'font-bold' }}"> My Contacts </a> | <a href="?filter=request" class="{{request()->filter == 'request' ? 'font-bold':'' }}">Request</a>
    </div>
    <livewire:contact-search/>
    @if (count($friends))
    @forelse ($friends as $user)
                <div class="card border-2 my-4 w-full md:w-6/12 mx-auto bg-gray-900">
                    <div class="card-body ">
                       <div class="flex justify-between">
                            <div class="flex">
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img src="/icons8-user-64.png" />
                                    </div>
                                </div>
                                <div class="mx-2">
                                    <h3 class="text-xl">{{$user->name}}</h3>
                                    <div>
                                        {{optional(optional($user->interest)->college)->name}}
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            @empty
                <h4 class="text-center mt-2">
                    No record found.
                </h4>
            @endforelse
    @else
    @forelse($requests as $r)
                <div class="card border-2 my-4 w-full md:w-6/12 mx-auto bg-gray-900">
                    <div class="card-body ">
                       <div class="flex justify-between">
                            <div class="flex">
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img src="/icons8-user-64.png" />
                                    </div>
                                </div>
                                <div class="mx-2">
                                    <h3 class="text-xl">{{$r->sender->name}}</h3>
                                    <div>
                                        {{optional(optional($r->sender->interest)->college)->name}}
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{route('student.phone.contact.accept', ['user' => $r->sender_id])}}">
                                @csrf
                                <button class="btn btn-sm btn-scholar">accept</button>
                            </form>
                       </div>
                    </div>
                </div>
            @empty
                <h4 class="text-center mt-2">
                    No record found.
                </h4>
            @endforelse
    @endif
</x-student.layout>
