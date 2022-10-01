<x-student.layout bg="bg-gray-100">

    <div x-data="{category: '*', }" class="h-screen overflow-auto">
        <h1 class="text-2xl uppercase text-center pt-4">
            Shop
        </h1>
        <div class="flex justify-center mt-4">
            <select class="select select-sm select-bordered" x-model="category">
                <option value="*">All</option>
                @foreach (\App\Models\ShopCategory::get() as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-center mt-4 w-10/12 mx-auto">
            @foreach ($items as $item)
                <div class="border-2 border-purple-800 bg-white shadow p-2 rounded-2xl mx-2 text-center" style="width: 250px !important;" x-show="category == '*'  || category == '{{$item->category->id}}'">
                    <h5>
                        <img src="/storage/{{$item->image}}" class="w-100  block h-32 mx-auto object-cover" alt="">
                        {{\Str::limit($item->description, 20)}}
                    </h5>
                    <span class="text-xl">
                        {{number_format($item->price, 2)}}
                    </span>
                    <div>
                        <x-scholar.modal button="view details">

                            <img src="/storage/{{$item->image}}" alt="" class="w-5/12 block mx-auto object-cover">

                            <h2>
                                {{$item->description}}
                            </h2>

                            <div class="text-2xl p-2 border-dashed border-2 my-4 bg-green-200 inline-block p-4">
                                {{$item->price, 2}} {{$item->price > 1 ? \Str::plural($item->crystal_type) : $item->crystal_type}}
                            </div>

                           <div class="mt-4">
                            <form action="{{route('student.shop.proceed.to.buy')}}" method="POST">
                                @csrf
                                <input type="hidden" name="itemId" value="{{$item->id}}">
                                <button class="btn btn-scholar">
                                    Buy now
                                </button>
                            </form>
                           </div>

                        </x-scholar.modal>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-student.layout>
