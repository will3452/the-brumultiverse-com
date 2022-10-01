<div>
    <div class="flex justify-center">
        <div class="w-full md:w-5/12 flex">
            <input type="text" class="text-gray-900 input input-sm block w-10/12 input-bordered" placeholder="Search name" wire:model="searchText">
            <button class="btn btn-scholar btn-sm mx-2" wire:click="search">search</button>
        </div>
    </div>
    @if ($isSearch != '')
        <div>
            @foreach ($searchResults as $user)
                @if (! auth()->user()->isFriendWith($user))
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
                                            {{$user->interest->college->name}}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if (! auth()->user()->hasSentFriendRequestTo($user))
                                        <button class="btn-scholar btn btn-sm" wire:click="addFriend({{$user->id}})">Add Friend</button>
                                    @else
                                        <button disabled class="btn-scholar btn btn-sm">Request sent</button>
                                    @endif

                                </div>
                        </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @if (count($searchResults) == 0)
                <h4 class="text-2xl text-center">
                    No Record found.
                </h4>
            @endif
        </div>
    @endif
</div>
