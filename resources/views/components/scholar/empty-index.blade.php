@props(['data' => []])

@if (! count($data))
    <div class="font-bold text-gray-500">
        No data found.
    </div>
@endif
