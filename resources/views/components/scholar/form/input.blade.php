@props(['label' => '', 'value'=> null, 'readonly' => false, 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true, 'type' => 'text'])
<div class="form-control w-full">
    <label class="label">
        <span class="label-text">
                {{$label}}
                @if ($required)
                <span class="text-red-600">
                    *
                </span>
            @endif
        </span>
    </label>
    <input
    value="{{$value ?? old($name)}}"
    name="{{$name}}"
    @if($required)
        required
    @endif
    type="{{$type}}"
    placeholder="{{$placeholder ?? $label}}"
    class="input input-bordered w-full @error($name) input-error @enderror"
    @if ($readonly)
        disabled
    @endif
    >
    <div class="label">
        <span class="label-text-alt">{{$help}}</span>
    </div>
    @error($name)
        <span class="text-red-300">{{$message}}</span>
    @enderror
</div>
