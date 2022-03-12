@props([
    'label' =>'',
    'id' => '',
    'placeholder' => '',
    'name' => '',
    'isRequired' => false,
    'type' => 'text',
    'value' => null,
    'help'=>null,
    'options' => [],
    ])
<div class="flex flex-col md:flex-row md:items-center">
    <label for="{{$id??$name}}" class="text-white font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
        {{$label}}
        @if ($isRequired)
            <span class="text-red-600">*</span>
        @endif
    </label>
    @if (strtolower($type) !== 'select')
<input type="{{$type}}" id="{{$id ?? $name}}" placeholder="{{$placeholder}}" name="{{$name}}" value="{{$value ?: old($name)}}" class="p-2  border border-gray-400 w-full md:w-8/12 text-gray-900">
    @endif

    @if ($type === 'select')
        <select
        @if ($isRequired)
            required
        @endif
        name="{{$name}}"
        id="{{$id ?? $name}}"
        class="p-2 border border-gray-400 w-full md:w-8/12 text-gray-900">
            @foreach ($options as $option)
                <option value="{{$option['value']}}">{{$option['label']}}</option>
            @endforeach
        </select>
    @endif
</div>
@error($name)
<div class="text-right">
    <x-form-error>
        {{$message}}
    </x-form-error>
</div>
@else
@if ($help)
    <div class="text-right">
        <x-form-help-text>
            {{$help}}
        </x-form-help-text>
    </div>
@endif
@enderror

@if ($slot)
    <div class="text-right">
        {{$slot}}
    </div>
@endif
