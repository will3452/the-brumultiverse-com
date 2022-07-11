<x-student.layout bg="bg-white">
    <div class="flex justify-center p-10">
        <div style="width: 600px !important; height: 200px !important;" class="p-5 relative">
            <div class="text-center text-2xl italic">
                {{$text}}
            </div>
            <div class="italic text-right absolute bottom-5 right-5">
                <div>{{$book->title}}</div>
                <div><span>- {{$book->account->penname}}</span></div>
            </div>
        </div>
    </div>
</x-student.layout>
