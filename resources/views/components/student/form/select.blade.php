@props(['model'=>'', 'change' => '', 'label' => '', 'name' => '', 'help' => '', 'required' => true, 'readonly' => false])
<div class="form-control w-full">
    <label class="label ">
        <span class="label-text text-white -mt-2">
                {{$label}}
                @if ($required)
                <span class="text-red-600">
                    *
                </span>
            @endif
        </span>
    </label>
    <select
    @if ($change)
        x-on:change="{{$change}}"
    @endif
    @if ($model)
        x-model="{{$model}}"
    @endif
    {{!$readonly ?:'disabled'}}
    class="select select-sm rounded-none select-bordered text-black @error($name) input-error @enderror"
    name="{{$name}}"
    @if($required)
        required
    @endif
    >
        {{$slot}}
    </select>
    <div class="label">
        <span class="label-text-alt">{{$help}}</span>
    </div>
    @error($name)
        <span class="text-red-300">{{$message}}</span>
    @enderror
</div>
