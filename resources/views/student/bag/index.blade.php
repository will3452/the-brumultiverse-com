<x-student.layout>

    <div class="bg-white" x-data="{category: '*', }">
        <h1 class="bg-white text-2xl uppercase text-center pt-4">
            My Bag
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
                <div class="border-2 shadow p-2 rounded-2xl mx-2 text-center" style="width: 250px !important;" x-show="category == '*'  || category == '{{$item->category->id}}'">
                    <h5>
                        <img src="/storage/{{$item->image}}" class="w-100  block h-32 mx-auto object-cover" alt="">
                        {{\Str::limit($item->description, 20)}}
                    </h5>
                </div>
            @endforeach
        </div>
    </div>

</x-student.layout>
