<x-student.layout bg='bg-white'>
    <div>
        <h1 class="text-center text-2xl uppercase bg-active py-5 mb-5">Packages available</h1>
        <div class="flex p-4 justify-center">
            @foreach ($packages as $p)
                <div class="w-full md:w-2/12 mx-2">
                    <div class="border-2 p-5 rounded-2xl bg-gray-200 text-center">
                        <img src="/storage/{{$p->picture}}" alt="">
                        <div class="uppercase font-bold font-mono mt-2 ">
                            {{$p->name}}
                        </div>
                        <div class="underline">
                            {{moneyFormat($p->cost)}}
                        </div>
                        <div class="text-xs ">
                            @foreach (extractPackageContent($p->content) as $key=>$item)
                                <li>
                                    {{$item}} {{$item > 1 ? plural(implode(' ', explode('_', $key))) : implode(' ', explode('_', $key))}}
                                </li>
                            @endforeach
                            <form action="{{route('student.buy.crystal.create.payment')}}" method="POST" class="p-4">
                                @csrf
                                <input type="hidden" name="package" value="{{$p->id}}">
                                <button href="#" class="btn bg-active px-4 rounded-2xl btn-sm mt-4">Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-student.layout>
