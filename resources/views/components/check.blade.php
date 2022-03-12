@props(['check'])
<div class="flex flex-col md:flex-row md:items-center">
    <label for="" class="text-gray-800 font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
    </label>
    <div class="p-2  border-2 border-gray-900 w-full md:w-8/12 bg-purple-700">
        <div class="uppercase font-bold">
            {{$check->title}}
        </div>
        <input
        type="checkbox"
        @if ($check->type === App\Models\FormCheck::TYPE_REQUIRED)
            required="true"
        @endif
        >
        {{$check->description}}
    </div>
</div>
