<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Groups Invitations',
                ],
            ]
        "
    />
    <x-scholar.page.title>
        Groups Invitations
    </x-scholar.page.title>
    <div id="invitation-list" class="mt-4">
        <input class="search input input-sm input-bordered mb-4" placeholder="Quick Search">
        <ul class="list">
            @foreach ($invitations as $i)
            <li class="bg-base-200 p-2 rounded mb-2">
                <h3 class="title tracking-wider">{{$i->title}}</h3>
                <p class="message text-xs">{{$i->body}} [ {{$i->created_at->format('m/d/y')}} ]</p>
                <div class="mt-2">
                    <form action="{{route('scholars.group.invitation.accept', ['invitation' => $i->id])}}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-scholar">Accept</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @push('body-script')
        <x-vendor.listjs/>

        <script>
            let options = {
                valueNames: ['title', 'message'],
            };

            var invitationList = new List('invitation-list', options);
        </script>
    @endpush
</x-scholar.layout>
