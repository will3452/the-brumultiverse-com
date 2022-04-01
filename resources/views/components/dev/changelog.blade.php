<x-scholar.material-container title="System Changelog" icon="/img/icons/dashboard/code.svg">
    <ul class="font-mono text-smw-full mt-4">
        @foreach (\App\Models\ChangeLog::latest()->get() as $key=>$item)
            <li class="mt-2 pl-5 flex items-center">
                <img src="/img/icons/dashboard/done.svg" class="w-4 mr-2" alt="">
                <div>
                    <span>{{$item->title}}</span> | {{$item->description}} [ <span class="text-xs">{{$item->created_at->diffForHumans()}}</span> ]
                </div>
            </li>
        @endforeach
    </ul>
</x-scholar.material-container>
